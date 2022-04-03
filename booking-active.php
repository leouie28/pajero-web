<?php
session_start();
ob_start();
$act[1] = 'active';
include ('includes/conn.php');
include ('includes/driver-header.php');
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
                        <a class="nav-link active" href="">Active 
                            <?php
                            $driver = $_SESSION['id'];
                            $bk_ids = array();
                            $pend = $conn->query("SELECT of_id, bk_id FROM offer WHERE driver_id = $driver AND of_stat = 'accepted' OR of_stat = 'otw'");
                            if($pend->num_rows>0)
                            {   
                                ?>
                                <div class="badge badge-danger rounded-circle">
                                <?= $pend->num_rows; ?>
                                </div>
                                <?php
                                while($bks = $pend->fetch_assoc())
                                {
                                    $bk_ids[] = $bks['bk_id'];
                                }
                            }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking-list.php">Available</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking-pending.php">Pending 
                            <?php
                            $driver = $_SESSION['id'];
                            $bk_ids = array();
                            $pend = $conn->query("SELECT of_id, bk_id FROM offer WHERE driver_id = $driver AND of_stat = 'pending'");
                            if($pend->num_rows>0)
                            {   
                                ?>
                                <div class="badge badge-danger rounded-circle">
                                <?= $pend->num_rows; ?>
                                </div>
                                <?php
                                while($bks = $pend->fetch_assoc())
                                {
                                    $bk_ids[] = $bks['bk_id'];
                                }
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-3">
                <?php
                $disemp = 0;
                $id = $_SESSION['id'];
                $sel = $conn->query("SELECT * FROM offer 
                LEFT JOIN booking ON offer.bk_id = booking.bk_id
                LEFT JOIN user ON booking.passenger_id = user.user_id 
                WHERE offer.driver_id = $id AND offer.of_stat = 'accepted' OR offer.of_stat = 'otw' ORDER BY offer.of_update DESC");
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
                            <div class="card alert-success text-dark mb-2">
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
                                    <hr>
                                    <div class="text-center my-3">
                                        <h5 class="text-primary">This passenger is waiting for you.</h5>
                                    </div>
                                    <div class="progress" style="height:10px;">
                                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
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
                    <div>
                        <img class="my-3 card-img-top" src="media/direction.svg" alt="Adventure">
                        <div class="mt-5 alert alert-info">
                            You don't have active offer at the moment. <a href="booking-list.php">Find booking here</a>
                        </div>
                    </div>
                    <?php
                }
                if($disemp==1)
                {
                    ?>
                    <div>
                        <img class="my-3 card-img-top" src="media/direction.svg" alt="Adventure">
                        <div class="mt-5 alert alert-info">
                            You don't have active offer at the moment. <a href="booking-list.php">Find booking here</a>
                        </div>
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
include ('includes/driver-watch.php');
include ('includes/footer.php');
?>