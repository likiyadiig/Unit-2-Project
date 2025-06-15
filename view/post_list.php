<!-- Lists all the posts inside the duscussion category -->
<?php include('header.php'); ?>

<h2>Forum Posts</h2>
<a href="index.php?action=add_post" class="btn btn-primary mb-3">New Post</a>

<?php 
// CRUD: implement get_posts() function
// $posts = get_posts();
// foreach ($posts as $post): 
?>
<div class="card mb-3">
    <div class="card-body">
        <!-- Replace the title, content and user using dynamic data from DB-->
        <h5 class="card-title">Welcome</h5>
        <p class="card-text">Sample post context</p>
        <small class="text-muted">Posted by User</small>
    <?php 
        // Sessions: check if current user is the post author in order to show a delete button
        // if $_SESSION...
        ?>
        <div class="mt-2">
                <button type="submit" class="btn btn-sm btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this post?')">
                    Delete
                </button>
            </form>
        </div>
        <?php 
        // endif; 
        ?>
    </div>

<?php include('footer.php'); ?>