<?php include 'includes/header.php' ?>

<?php validation_code(); ?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="" role="form">
                    <h1 class="text-center">Enter Code</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="#######" name="code">
                    </div>
                    <div class="form-group text-center">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success btn-block" name="code-submit" >Continue</button>
                        </div>

                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-danger btn-block" name="code-cancel"> Cancel</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>