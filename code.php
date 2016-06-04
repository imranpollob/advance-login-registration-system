<?php include 'includes/header.php' ?>

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
                <h1 class="text-center">Enter Code</h1>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="#######">
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn-success" >Continue</button>
                    <button type="button" class="btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>