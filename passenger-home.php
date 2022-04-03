<?php
ob_start();
$act[0] = 'active';
include ('includes/conn.php');
include ('includes/passenger-header.php');
?>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar">
            <i class="fa fa-bars"></i>
        </button>
        <h5>Pajero web-app</h5>
    </div>
    <div class="content p-3">

       <div class="card shadow">
            <div class="card-header">
                <h5>Active booking</h5>
            </div>
            <div class="card-body">

                <?php

                if(isset($_GET['completed']))
                {
                    $id = $_GET['completed'];

                    $sel = $conn->query("SELECT bk_id, driver_id FROM offer WHERE of_id =  $id");
                    $res = $sel->fetch_assoc();
                    $bk_id = $res['bk_id'];
                    $driver_id = $res['driver_id'];

                    $upd = "UPDATE offer SET of_stat = 'completed' WHERE of_id = $id";
                    if($conn->query($upd)===TRUE)
                    {
                        $upd2 = "UPDATE booking SET bk_stat = 'completed', driver_id = $driver_id WHERE bk_id = $bk_id";
                        if($conn->query($upd2)===TRUE)
                        {
                            ?>
                            <div class="cus-modal" style="display:flex;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="alert alert-success">
                                            <strong>Trip successfully completed!</strong><br>
                                            Thank you for using our system
                                        </div>
                                        <div class="text-right">
                                            <a href="home.php" class="btn btn-dark">Close</a>
                                            <a href="booking.php" class="btn btn-info">Book Again <i class="fa fa-map-marker"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }


                $id = $_SESSION['id'];
                $sel = $conn->query("SELECT * FROM booking WHERE passenger_id = $id AND NOT bk_stat = 'completed'");
                if($sel->num_rows>0)
                {
                    while($row = $sel->fetch_assoc())
                    {
                        $bk_id = $row['bk_id'];
                        ?>
                        <div class="alert-secondary mb-2 d-flex justify-content-between align-items-center border shadow-sm rounded" style="overflow: hidden;">
                            <div class="col-8">
                                Route:
                                <strong><?= $row['bk_route']; ?></strong>
                            </div>
                            <div class="p-3 bg-info col-3">
                                <?php
                                if($row['bk_stat']=='searching')
                                {
                                    ?> 
                                    <a href="waiting-booking.php?booking=<?= $row['bk_id']; ?>">
                                        <strong class="text-white">VIEW</strong>
                                    </a>
                                    <?php
                                }
                                else
                                {
                                    $ofr = $conn->query("SELECT of_id FROM offer WHERE bk_id = $bk_id AND of_stat = 'accepted' OR of_stat = 'otw'");
                                    $of = $ofr->fetch_assoc();
                                    ?> 
                                    <a href="waiting-pajero.php?pajero=<?= $of['of_id']; ?>&booking=<?= $row['bk_id']; ?>">
                                        <strong class="text-white">VIEW</strong>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div>
                        <img class="my-3 card-img-top" src="media/travel.svg" alt="Adventure">
                        <div class="mt-5 alert alert-info">
                            You don't have active booking at the moment.
                        </div>
                        <div class="text-center">
                            <a href="booking.php" class="btn btn-info">Book now <i class="fa fa-map-marker"></i></a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
       </div>

<?php
include ('includes/footer.php');
?>