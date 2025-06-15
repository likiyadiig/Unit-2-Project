<!-- Login page using Bootstrap cards -->
<?php include('header.php'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <!-- Sessions: add error message to display here if login fails -->
                <form method="post" action="index.php">
                    <input type="hidden" name="action" value="login">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <!-- Cookies: implement remember me feature -->
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>