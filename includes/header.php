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
<div class="sidenav">
    <div class="avatar">
        <div class="avatar-img">
            <!-- <img src="" alt=""> -->
            <i class="fa fa-user-circle"></i>
        </div>
        <h5>Pajero Web-App</h5>
    </div>
    <hr>
    <div class="nav-link">
        <ul>
            <li class="<?= $act[0]; ?>"><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="<?= $act[1]; ?>"><a href="#"><i class="fa fa-user-plus"></i> Signup</a></li>
            <li class="<?= $act[2]; ?>"><a href="#"><i class="fa fa-sign-in"></i> Login</a></li>
        </ul>
    </div>
</div>