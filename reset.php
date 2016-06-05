<?php include 'includes/header.php' ?>
<?php include 'includes/nav.php' ?>


<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class="text-center">Reset Password</h2>
                <hr>

                <div class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="New Password">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="confirm-password" placeholder="Confirm Password">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Reset Password</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>