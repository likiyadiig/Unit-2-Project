<?php
// Load required model and fetch categories
require_once(__DIR__ . '/../model/post_db.php');
$categories = get_categories();

// Get category_id from URL to pre-select it
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

include('header.php');
?>

<h2>Create New Post</h2>

<div class="row">
    <div class="col-md-8">
        <!-- Sessions: check if user is logged in, if not redirect to login page -->

        <form method="post" action="index.php?action=add_post&category_id=<?= $category_id ?>">
            <input type="hidden" name="category_id" value="<?= $category_id ?>">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category_id" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>" 
                            <?= ($category_id === $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
            <a href="index.php?action=forum_list" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
