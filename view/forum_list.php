<!-- Main Forum List View -->
<?php include('header.php'); ?>

<h2>Forum Categories</h2>
<div class="row">
    <div class="col-md-8">
        <div class="list-group">
            <!-- Example category card, can be deleted -->
            <a href="index.php?action=view_posts&category=1" class="list-group-item list-group-item-action">
                <h5>Example Discussion Card</h5>
                <p class="mb-1">Talk about stuff here</p>
                <small>15 posts</small>
            </a>
            <!-- Dyanmic content -->
             <?php 
            // CRUD: implement get_categories() function
            // $categories = get_categories();
            // foreach ($categories as $category): 
            ?>
            <!-- Category items displayed here -->
            <?php 
            // endforeach; 
            ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>