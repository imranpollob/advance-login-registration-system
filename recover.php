<?php include 'includes/header.php' ?>
<?php include 'includes/nav.php' ?>


<?php recover_password(); ?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class="text-center">Recover Password</h2>
                <hr>
                <form action="" method="post" role="form" autocomplete="on">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <button class="btn btn-success btn-block" name="recover-submit" >Send Password Reset Link</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-danger btn-block" name="cancel-submit" >Cancel</button>
                        </div>
                    </div>
                    <input type="hidden" name="token" class="hide" value="<?php echo token_generator();?>">
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>