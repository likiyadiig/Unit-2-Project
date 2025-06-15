<?php
// Base URL of the project
$base_url = '/forum-project';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Simple Forum</a> <!-- Site Title -->
            <div class="navbar-nav ms-auto">
                <!-- Sessions: check if user is logged in. If user is logged in, show the user ID in navbar with <span>. If user is logged in, display Logout link and Login and Register links do not dispaly. Else, Login and Register links are displayed. -->
                <a class="nav-link" href="<?php echo $base_url; ?>/index.php?action=login">Login</a>
                <a class="nav-link" href="<?php echo $base_url; ?>/index.php?action=register">Register</a>
                <a class="nav-link" href="<?php echo $base_url; ?>/index.php?action=logout">Logout</a>
                <a class="nav-link" href="<?php echo $base_url; ?>/index.php?action=add_post">New Post</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">