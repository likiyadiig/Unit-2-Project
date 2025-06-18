<!-- Main Forum List View -->
<?php 
include('header.php'); 
require_once('model/post_db.php');

// Get all categories
$categories = get_categories();
?>

<h2>Forum Categories</h2>
<div class="row">
    <div class="col-md-8">
        <div class="list-group">
            <?php foreach ($categories as $category): ?>
                <a href="index.php?action=view_posts&category_id=<?= $category['id']; ?>" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?= htmlspecialchars($category['name']); ?></h5>
                    <p class="mb-1">Discuss <?= htmlspecialchars($category['name']); ?> topics</p>
                    <small>View Posts</small>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
