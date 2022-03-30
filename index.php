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
<div class="sidenav">
    <div class="avatar">
        <div class="avatar-img">
            <!-- <img src="" alt=""> -->
            <i class="fa fa-user-circle"></i>
        </div>
        <h6><span class="badge badge-secondary">@user</span></h6>
    </div>
    <hr>
    <div class="nav-link">
        <ul>
            <li><a href="#"><i class="fa fa-table"></i> Link 1</a></li>
            <li><a href="#"><i class="fa fa-table"></i> Link 2</a></li>
            <li><a href="#"><i class="fa fa-table"></i> Link 3</a></li>
        </ul>
    </div>
</div>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="content p-3">

        <div class="card shadow">
            <div class="card-header">
                <h5>Booking form</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Pickup Place:</label>
                    <input type="text" name="" class="form-control" placeholder="Type specific location"/>
                    <hr>
                    <label>Destination Place:</label>
                    <input type="text" name="" class="form-control" placeholder="Type specific location"/>
                    <hr>
                    <label>Note: <span class="text-secondary">optional</span></label>
                    <textarea name="" placeholder="Additional information.." class="form-control" style="min-height: 120px;"></textarea>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-danger">Reset</button>
                        <button class="btn btn-info">Place Booking</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-footer">
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-info rounded-pill shadow-sm">Button 1</button>
                <button class="btn btn-info rounded-pill shadow-sm">Button 2</button>
                <button class="btn btn-info rounded-pill shadow-sm">Button 3</button>
            </div>
        </div>
    </div>
</div>
<script src="asset/custom.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>