<?php
ob_start();
$act[2] = 'active';
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
    <div class="content p-3">

       <div class="card shadow">
            <div class="card-header">
                <h5>Your History</h5>
            </div>
            <div class="card-body p-2">
                <?php
                $id = $_SESSION['id'];
                $sel = $conn->query("SELECT * FROM offer 
                LEFT JOIN booking ON offer.bk_id = booking.bk_id 
                WHERE offer.driver_id = $id ORDER BY offer.of_update DESC");
                if($sel->num_rows>0)
                {
                    while($row = $sel->fetch_assoc())
                    {
                        if($row['of_stat']=='completed'){
                            $stat = '<span class="badge badge-success">Completed</span>';
                            ?>
                            <div class="border rounded alert-info my-2 p-2">
                                Status: <h6 class="d-inline"><?= $stat; ?></h6><br>
                                Date: <strong>
                                    <?php
                                    $date = $row['of_update'];
                                    $date = new DateTime($date);
                                    echo date_format($date, 'M j, Y \a\t G:ia')
                                    ?>
                                </strong>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col">
                                        From:<br>
                                        <strong><?= $row['bk_from']; ?></strong>
                                    </div>
                                    <div class="col">
                                        Route:<br>
                                        <strong><?= $row['bk_route']; ?></strong>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        elseif($row['of_stat']=='pending'){
                            if(!empty($row['driver_id']) && $row['driver_id'] != $id){
                                $stat = '<span class="badge badge-info">Taken by other</span>';
                                ?>
                                <div class="border rounded alert-info my-2 p-2">
                                    Status: <h6 class="d-inline"><?= $stat; ?></h6><br>
                                    Date: <strong>
                                        <?php
                                        $date = $row['of_update'];
                                        $date = new DateTime($date);
                                        echo date_format($date, 'M j, Y \a\t G:ia');
                                        ?>
                                    </strong>
                                    <hr class="my-2">
                                    <div class="row">
                                        <div class="col">
                                            From:<br>
                                            <strong><?= $row['bk_from']; ?></strong>
                                        </div>
                                        <div class="col">
                                            Route:<br>
                                            <strong><?= $row['bk_route']; ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-secondary">
                                No data for history at the moment. <a href="booking-list.php">Find booking here to create history.</a>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
       </div>

        <div class="cus-modal" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h5>Modal Title</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h6 class="mt-3">Waiting for driver...</h6>
                    </div>
                    <hr>
                    <div class="alert alert-info">
                        Your booking is now in search! Driver/s will send offer to your booking and need to to be accepted.
                    </div>
                </div>
            </div>
        </div>

<?php
include ('includes/driver-watch.php');
include ('includes/footer.php');
?>