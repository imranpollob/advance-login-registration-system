<?php include 'includes/header.php' ?>
<?php include 'includes/nav.php' ?>

<?php validate_user_registration(); ?>

<div class="panel panel-default col-lg-6 col-lg-offset-3">

    <div class="panel-body">

        <div class="col-lg-6 text-center">
            <a href="login.php" class="not-focused-link">Login</a>
        </div>

        <div class="col-lg-6 text-center">
            <a href="register.php" class="focused-link">Register</a>
        </div>
        <br>
        <hr>

        <form action="" method="post">
            <div class="form-group">
                <input class="form-control" placeholder="First Name" name="first_name" required type="text">
            </div>

            <div class="form-group">
                <input class="form-control" placeholder="Last Name" name="last_name" required type="text">
            </div>

            <div class="form-group">
                <input class="form-control" placeholder="Username" name="username" required type="text">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Email Address" name="email" required type="email">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" required type="password">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Confirm Password" name="confirm_password" required type="password">
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary btn-block" type="submit" name="register_submit">Register Now</button>
            </div>
        </form>

    </div>
</div>


<?php include("includes/footer.php") ?>