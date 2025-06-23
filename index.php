<?php
// TEMPORARY - just for testing remember-me
session_start();
if (isset($_SESSION['user_id'])) {
    echo "<div style='background: green; color: white; padding: 10px;'>AUTO-LOGGED IN as user ID: " . $_SESSION['user_id'] . "</div>";
}
// Check for remember me cookie before any action processing - JS
$remember_token = $_COOKIE['remember_me'] ?? null;

if ($remember_token) {
    require_once('model/user_db.php');
    $user = get_user_by_token($remember_token);
    
    if ($user) {
        // Auto-login the user
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    } else {
        // Invalid token - delete the bad cookie
        setcookie('remember_me', '', strtotime('-1 year'), '/');
    }
}


$action = filter_input(INPUT_GET, 'action');

// Had an issue with the register case not creating a user in the db, this fixed it - JS
// checks POST for action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
}

if ($action === NULL) {
    $action = 'forum_list';
}

switch ($action) {
    case 'forum_list':
        include('view/forum_list.php');
        break;

    case 'view_posts':
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        if (!$category_id) {
            $error = "Invalid category.";
            include('view/error.php');
            exit();
        }
        include('view/post_list.php');
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once('model/user_db.php');

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = validate_user($username, $password); 


            if ($user) {
                // Remember me check - JS
                $remember = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user_id = $user['id'];
                
                if ($remember) {
                    echo "Remember me was checked!";
                    $token = bin2hex(random_bytes(16)); // random 16 digit token
                    set_remember_token($user_id, $token);
                    setcookie('remember_me', $token, time() + (86400 * 30), '/');
                }
                
                if (session_status() === PHP_SESSION_NONE) { // rewrote this just a little for error handling - JS
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password.";
                include('view/login.php');
            }
        } else {
            include('view/login.php');
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once('model/user_db.php');

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($username && $email && $password) {
                register_user($username, $email, $password);
                header("Location: index.php?action=login");
                exit();
            } else {
                $error = "Please fill out all fields.";
                include('view/register.php');
            }
        } else {
            include('view/register.php');
        }
        break;

    case 'add_post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once('model/post_db.php');

            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($category_id && $title && $content) {
                add_post($category_id, $title, $content);
                header("Location: index.php?action=view_posts&category_id=$category_id");
                exit();
            } else {
                $error_message = "Please fill out all fields correctly.";
                include('view/post_add.php');
            }
        } else {
            include('view/post_add.php');
        }
        break;

    case 'edit_post':
        require_once('model/post_db.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($id && $title && $content) {
                update_post($id, $title, $content);
                $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
                header("Location: index.php?action=view_posts&category_id=$category_id");
                exit();
            } else {
                $error_message = "Please fill out all fields.";
                include('view/post_edit.php');
            }

        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $post = get_post_by_id($id);
            if ($post) {
                include('view/post_edit.php');
            } else {
                $error = "Post not found.";
                include('view/error.php');
            }
        }
        break;

    case 'delete_post':
        require_once('model/post_db.php');

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

        if ($id !== false && $id !== null) {
            delete_post($id);
        }

        if ($category_id) {
            header("Location: index.php?action=view_posts&category_id=$category_id");
        } else {
            header("Location: index.php?action=forum_list");
        }
        exit();

    default:
        include('view/forum_list.php');
        break;
}
?>
