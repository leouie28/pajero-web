<?php
session_start();
ob_start();
$act[2] = 'active';
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
        if(isset($_SESSION['res']))
        {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
        ?>
        
        <div class="card mt-2 shadow">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="">Available</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pending 
                            <div class="badge badge-danger rounded-circle">
                                <?php
                                $driver = $_SESSION['id'];
                                $bk_ids = array();
                                $pend = $conn->query("SELECT of_id, bk_id FROM offer WHERE driver_id = $driver AND of_stat = 'pending'");
                                if($pend->num_rows>0)
                                {
                                    echo $pend->num_rows;
                                    while($bks = $pend->fetch_assoc())
                                    {
                                        $bk_ids[] = $bks['bk_id'];
                                    }
                                }
                                ?>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-3">
                <?php
                $disemp = 0;
                $sel = $conn->query("SELECT * FROM booking 
                LEFT JOIN user ON booking.passenger_id = user.user_id 
                WHERE bk_stat = 'searching' ORDER BY bk_id DESC");
                if($sel->num_rows>0)
                {
                    while($row = $sel->fetch_assoc())
                    {
                        if(!in_array($row['bk_id'], $bk_ids))
                        {
                            $name = $row['user_fname'] . " " . $row['user_lname'];
                            if($row['bk_type']=='standard')
                            {
                                $type = '<span class="badge badge-info">Standard</span>';
                            }
                            elseif($row['bk_type']=='special')
                            {
                                $type =  '<span class="badge badge-info">Special</span>';
                            }
                            ?>
                            <div class="card mb-2">
                                <div class="card-header p-2">
                                    <h6 class="m-0" style="font-size:18px;"> <?= $type . " " . $name; ?></h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="col">
                                        <i class="fa fa-map-marker"></i> Pickup: <strong><?= $row['bk_from']; ?></strong>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-location-arrow"></i> Destination: <strong><?= $row['bk_route']; ?></strong>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-user"></i> Pax: <strong><?= $row['bk_pax']; ?></strong>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-sticky-note"></i> Note: <?= $row['bk_note']; ?>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="text-primary">
                                            <i class="fa fa-clock-o"></i> 
                                            Posted: 
                                            <?php
                                            $time = $row['bk_update'];
                                            $time = new DateTime($time);
                                            $posted = $time->diff(new DateTime());
                                            if($posted->d>=1)
                                            {
                                                echo $posted->d . ' day ago';
                                            }
                                            elseif($posted->h>=1)
                                            {
                                                echo $posted->h . ' hr ago';
                                            }
                                            elseif($posted->i>=1)
                                            {
                                                echo $posted->i . ' m ago';
                                            }
                                            ?>
                                        </div>
                                        <button class="offer-btn btn btn-success btn-sm" data-id="<?= $row['bk_id']; ?>" data-user="<?= $name; ?>">OFFER SERVICE</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            $disemp = 1;
                        }
                    }
                }
                else
                {
                    ?>
                    <div class="alert alert-info py-4">
                        No available booking at the moment. <a href="">Refresh page</a>
                    </div>
                    <?php
                }
                if($disemp==1)
                {
                    ?>
                    <div class="alert alert-info my-4">
                        No available booking at the moment. <a href="">Refresh page</a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="cus-modal offer-modal">
            <div class="card">
                <div class="card-header">
                    <h5>User booking</h5>
                </div>
                <div class="card-body">
                    <form action="backend/backend1.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="bk" value="">
                            <label>Message:</label>
                            <select name="msg" class="form-control">
                                <option value="Hi! Im available to be your service">Hi! I'm available to be your service</option>
                                <option value="Hi! Im near from your location">Hi! I'm near from your location.</option>
                            </select>
                            <label>Time to get there:</label>
                            <select name="time" class="form-control">
                                <option value="5">I'll be there in 5 minutes or less</option>
                                <option value="10">I'll be there in 10 minutes or less</option>
                                <option value="20">I'll be there in 20 minutes or less</option>
                                <option value="30">I'll be there in 30 minutes or less</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn-cl btn btn-secondary">Close</button>
                            <button type="submit" name="offer-btn" class="btn btn-success">Submit Offer</button>
                        </div>
                    </form>
                    <hr>
                    <div class="alert alert-info">
                        This booking will be your passenger if this offer get accepted.
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('.offer-btn').click(function() {
                name = $(this).data('user');
                bk = $(this).data('id');
                $('.offer-modal').css('display','flex');
                $('.offer-modal .card h5').text(name + ' booking');
                $('.offer-modal form input[name=bk]').val(bk);
            })
        </script>
<?php
include ('includes/footer.php');
?>