<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="asset/style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="media/MDTL.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
<div class="content-block"></div>
<?php
$id = $_SESSION['id'];

$user = $conn->query("SELECT * FROM user WHERE user_id = $id");
if($user->num_rows>0)
{
    $user = $user->fetch_assoc();
}
else
{
    ?>
    <script>
        alert('Invalid user!');
        window.location = 'login.php';
    </script>
    <?php
}
?>
<div class="sidenav">
    <div class="avatar">
        <div class="avatar-img">
            <!-- <img src="" alt=""> -->
            <i class="fa fa-user-circle"></i>
        </div>
        <h5><span class="badge badge-secondary"><?= $user['user_fname'] . " " . $user['user_lname']; ?></span></h5>
    </div>
    <hr>
    <div class="nav-link">
        <ul>
            <li class="<?= $act[0]; ?>"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="<?= $act[1]; ?>"><a href="booking.php"><i class="fa fa-map-marker"></i> Booking</a></li>
            <li class="<?= $act[2]; ?>"><a href="history.php"><i class="fa fa-history"></i> History</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
</div>