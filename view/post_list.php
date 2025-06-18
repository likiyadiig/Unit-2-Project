<?php include('header.php'); ?>
<?php require_once('model/post_db.php'); ?>

<?php
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

if (!$category_id) {
    echo '<p class="text-danger">Invalid category.</p>';
    include('footer.php');
    exit();
}

$posts = get_posts_by_category($category_id);
?>

<h2>Forum Posts</h2>
<a href="index.php?action=add_post&category_id=<?= $category_id ?>" class="btn btn-primary mb-3">New Post</a>

<?php foreach ($posts as $post): ?>
    <div class="card p-3 mb-3">
        <h4><?= htmlspecialchars($post['title']); ?></h4>
        <p><?= nl2br(htmlspecialchars($post['content'])); ?></p>
        <a href="index.php?action=delete_post&id=<?= $post['id']; ?>" class="btn btn-danger mt-2">Delete</a>
        
        <a href="index.php?action=edit_post&id=<?= $post['id']; ?>" class="btn btn-secondary mt-2 ms-2">Edit</a>
    </div>
<?php endforeach; ?>

<?php include('footer.php'); ?>
