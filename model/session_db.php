<!-- added function start_custom_session - starts inital session
    function is_user_logged_in - checks if user is logged in via user_id
    function log_out_user - logs user out and remember me   - Jeremy 6/24/25  --!>
<?php
function start_custom_session() {
    session_start();
}

function log_in_user($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
}

function is_user_logged_in() {
    return isset($_SESSION['user_id']);
}

function log_out_user() {
    session_unset();
    session_destroy();
    setcookie('remember_me', '', time() - 3600, '/');
}
?>
