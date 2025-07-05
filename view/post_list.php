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
        <div class="d-flex gap-2 mt-2">
            <a href="index.php?action=edit_post&id=<?= $post['id']; ?>" class="btn btn-secondary btn-sm" style="width: 80px;">Edit</a>
            <a href="index.php?action=delete_post&id=<?= $post['id']; ?>" class="btn btn-danger btn-sm" style="width: 80px;">Delete</a>
        </div>
    </div>
<?php endforeach; ?>

<?php include('footer.php'); ?>
