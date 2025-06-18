<?php
require_once('database.php');


// Get all posts
function get_posts() {
    global $db;
    $query = 'SELECT * FROM posts ORDER BY created_at DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

//Get post by category
function get_posts_by_category($category_id) {
    global $db;
    $query = 'SELECT * FROM posts WHERE category_id = :category_id ORDER BY created_at DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $posts = $statement->fetchAll();
    $statement->closeCursor();
    return $posts;
}


// Add a new post
function add_post($category_id, $title, $content) {
    global $db;
    $query = 'INSERT INTO posts (category_id, title, content) 
              VALUES (:category_id, :title, :content)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);
    $success = $statement->execute();
    $statement->closeCursor();

    if (!$success) {
        echo "❌ Insert failed.";
    }
}


// Delete a post
function delete_post($id) {
    global $db;
    $query = 'DELETE FROM posts WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}


function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories ORDER BY name';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}
?>
