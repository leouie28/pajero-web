<?php
session_start();
ob_start();
$act[2] = 'active';
include ('includes/header.php');
?>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar">
            <i class="fa fa-bars"></i>
        </button>
        <h5>Pajero web-app</h5>
    </div>
    <div class="content p-4 d-flex justify-content-center align-items-center" style="height: 90vh;">

        <div class="card shadow login">
            <div class="card-header text-center">
                <h5>Login form</h5>
            </div>
            <div class="card-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="user" required>
                        <label>Password:</label>
                        <input type="password" class="form-control mb-3" name="pass" required>
                        <?php
                        include ('includes/conn.php');
                        if(isset($_POST['login']))
                        {
                            $user = $_POST['user'];
                            $pass = $_POST['pass'];

                            $sel = $conn->query("SELECT * FROM user WHERE user_user = '$user' AND user_pass = '$pass'");
                            if($sel->num_rows>0)
                            {
                                $row = $sel->fetch_assoc();
                                if($row['user_type']=='passenger')
                                {
                                    $_SESSION['id'] = $row['user_id'];
                                    $_SESSION['type'] = $row['user_type'];
                                    header('location:booking.php');
                                }
                                elseif($row['user_type']=='driver')
                                {
                                    $_SESSION['id'] = $row['user_id'];
                                    $_SESSION['type'] = $row['user_type'];
                                    header('location:booking-list.php');
                                }
                                elseif($row['user_type']=='admin')
                                {
                                    $_SESSION['id'] = $row['user_id'];
                                    $_SESSION['type'] = $row['user_type'];
                                    header('location:dashboard.php');
                                }
                            }
                            else
                            {
                                ?>
                                <div class="text-center">
                                    Invalid username or password
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="text-center mt-2">
                            <button type="submit" name="login" class="btn btn-success">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
include ('includes/footer.php');
?>