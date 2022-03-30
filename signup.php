<?php
include ('includes/header.php');
?>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar">
            <i class="fa fa-bars"></i>
        </button>
        <h5>Pajero web-app</h5>
    </div>
    <div class="content p-2">

        <div class="card">
            <div class="card-header">
                <h5>Signup form</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" class="form-control" name="">
                    <label>Laste Name:</label>
                    <input type="text" class="form-control" name="">
                    <label>Address:</label>
                    <input type="text" class="form-control" name="">
                    <label>Email: <span class="text-secondary">Optional</span></label>
                    <input type="text" class="form-control" name="">
                    <hr>
                    <label>Username:</label>
                    <input type="text" class="form-control" name="">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="">
                    <label>Confirm Password:</label>
                    <input type="password" class="form-control" name="">
                    <div class="text-right mt-3">
                        <button class="btn btn-secondary">Reset</button>
                        <button class="btn btn-success">Signup</button>
                    </div>
                </div>
            </div>
        </div>
<?php
include ('includes/footer.php');
?>