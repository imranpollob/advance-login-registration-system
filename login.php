<?php include 'includes/header.php' ?>
<?php include 'includes/nav.php' ?>

<?php validate_user_login(); ?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <?php display_message(); ?>
    </div>
</div>

<div class="row">
    <div class="panel panel-default col-lg-6 col-lg-offset-3">

        <div class="panel-body">

            <div class="col-lg-6 text-center">
                <a href="login.php" class="focused-link">Login</a>
            </div>

            <div class="col-lg-6 text-center">
                <a href="register.php" class="not-focused-link">Register</a>
            </div>
            <br>
            <hr>

            <form action="" method="post">
                <div class="form-group">
                    <input class="form-control" placeholder="Email Address" name="email" required type="email">
                </div>

                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" required type="password">
                </div>

                <div class="form-group text-center">
                    <div class="checkbox">
                            <input type="checkbox" name="remember"> Remember me
                    </div>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block" type="submit" name="register_submit">Login</button>
                </div>

                <div class="form-group text-center">
                    <a href="" class="">Forget Password?</a>
                </div>
            </form>

        </div>
    </div>


</div>


<?php include("includes/footer.php") ?>