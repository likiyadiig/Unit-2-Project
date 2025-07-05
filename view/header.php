<?php
//Had to change the base url to a dynamic one to test
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$base_url = $protocol . $host . $base_path;
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
        <a class="navbar-brand" href="index.php">Simple Forum</a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                require_once('model/session_db.php');

                if (is_user_logged_in()) : ?>
                    <li class="nav-item me-3">
                        <span class="navbar-text text-white">
                            Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>/index.php?action=logout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>/index.php?action=add_post">New Post</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>/index.php?action=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>/index.php?action=register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    <div class="container mt-4">
