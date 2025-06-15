<!-- Simple Forum App ACTIONS -->
<?php
$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = 'forum_list';
}

if ($action == 'forum_list') {
    include('view/forum_list.php');
} else if ($action == 'view_posts') {
    include('view/post_list.php');
} else if ($action == 'login') {
    include('view/login.php');
} else if ($action == 'register') {
    include('view/register.php');
} else if ($action == 'add_post') {
    include('view/post_add.php');
}
//CRUD: create action to delete a post
?>