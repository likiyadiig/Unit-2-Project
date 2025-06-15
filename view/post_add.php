<?php include('header.php'); ?>

<h2>Create New Post</h2>

<div class="row">
    <div class="col-md-8">
        <!-- Sessions: check if user is logged in, if not redirect to login page -->

          <form method="post" action="../index.php">
            <input type="hidden" name="action" value="add_post">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category_id" required>
                    <option value="">Select a category</option>
                    <!-- CRUD: populate categories from database -->
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
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
        
    </div>
</div>

<?php include('footer.php'); ?>