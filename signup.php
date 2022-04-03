<?php
session_start();
ob_start();
$act[1] = 'active';
include ('includes/conn.php');
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

        <?php
        if(isset($_POST['signup']))
        {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $user = $_POST['user'];
            $pass = $_POST['pass2'];
            $date = date('Y-m-d');
            $type = "passenger";

            $val = $conn->query("SELECT user_id FROM user WHERE user_user= '$user'");
            if($val->num_rows>0)
            {
                ?>
                <div class="alert alert-danger">
                    Failed to signup! Username already registered.
                </div>
                <?php
            }
            else
            {
                $ins = "INSERT INTO user (user_type, user_fname, user_lname, user_address, user_email, user_user, user_pass, user_create) 
                VALUE ('$type', '$fname', '$lname', '$address', '$email', '$user', '$pass', '$date')";
                if($conn->query($ins)===TRUE)
                {
                    $_SESSION['signup'] = $user;
                    header('location:signup.php');
                }
                else
                {
                    ?>
                    <div class="alert alert-danger">
                        Failed to signup! Please try again.
                    </div>
                    <?php
                }
            }
        }
        if(isset($_SESSION['signup']))
        {
            ?>
            <div class="px-3 d-flex justify-content-center align-items-center" style="min-height:90vh;">
                <div class="card">
                    <div class="card-body">
                        <img class="my-3 card-img-top" src="media/success.svg" alt="Adventure">
                        <div class="mt-5 alert alert-info">
                            <strong>Signup Successfully!</strong> Thankyou for using our system.
                        </div>
                        <div class="text-center">
                            <a href="signup.php?redirect=login" class="btn btn-info">Continue and Book Now <i class="fa fa-map-marker"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        if(isset($_GET['redirect']))
        {
            $user = $_SESSION['signup'];
            $sel = $conn->query("SELECT user_id, user_type FROM user WHERE user_user = '$user'");
            if($sel->num_rows>0)
            {
                $row = $sel->fetch_assoc();
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['type'] = $row['user_type'];
                unset($_SESSION['signup']);
                header('location:home.php');
            }
            else
            {
                ?>
                <script>
                    alert('Failed to redirect user. Please login you account manually');
                    window.location = 'login.php';
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <div class="card">
                <div class="card-header">
                    <h5>Passenger Signup</h5>
                </div>
                <div class="card-body">
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" class="form-control" name="fname" required>
                            <label>Laste Name:</label>
                            <input type="text" class="form-control" name="lname" required>
                            <label>Address:</label>
                            <input type="text" class="form-control" name="address" required>
                            <label>Email: <span class="text-secondary">Optional</span></label>
                            <input type="text" class="form-control" name="email">
                            <hr>
                            <label>Username:</label>
                            <input type="text" class="form-control" name="user" required>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="pass1" required>
                            <label>Confirm Password: <span class="pass-res"></span></label>
                            <input type="password" class="form-control" name="pass2" required>
                            <div class="text-right mt-3">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" name="signup" class="btn btn-success" disabled>Signup</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $('form input[name=pass2]').keyup(function() {
                    pass = $('form input[name=pass1]').val();
                    if($(this).val().length >= 2)
                    {
                        if($(this).val()==pass)
                        {
                            $('form button[type=submit]').removeAttr('disabled');
                            $('.pass-res').addClass('text-success').removeClass('text-danger').text('Password matched!');
                        }
                        else
                        {
                            $('form button[type=submit]').attr('disabled','');
                            $('.pass-res').addClass('text-danger').text('Password does not match');
                        }
                    }
                    
                });
            </script>
            <?php
        }
include ('includes/footer.php');
?>