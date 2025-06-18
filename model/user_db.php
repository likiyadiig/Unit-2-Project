<?php
// User Database Functions
require_once('database.php');

// Register a new user
function register_user($username, $email, $password) {
    global $db;

    $query = 'INSERT INTO users (username, email, password) 
              VALUES (:username, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT)); 
    $statement->execute();
    $statement->closeCursor();
}

//Validate user login credentials
function validate_user($username, $password) {
    global $db;

    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

?>
