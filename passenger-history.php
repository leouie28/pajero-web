<?php
ob_start();
$act[2] = 'active';
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
                <h5>Your History</h5>
            </div>
            <div class="card-body p-2">
                <?php
                $id = $_SESSION['id'];
                $sel = $conn->query("SELECT * FROM booking 
                LEFT JOIN user ON booking.driver_id = user.user_id 
                WHERE booking.passenger_id = $id AND NOT booking.bk_stat = 'searching' AND NOT booking.bk_stat = 'waiting'
                ORDER BY booking.bk_update DESC");
                if($sel->num_rows>0)
                {
                    while($row = $sel->fetch_assoc())
                    {
                        ?>
                        <div class="border rounded alert-secondary my-2 p-2">
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
                            <hr class="my-2">
                            Pajero: <strong><?= $row['user_fname'] . ' ' . $row['user_lname']; ?></strong><br>
                            Date: <strong>
                                    <?php
                                    $date = $row['bk_update'];
                                    $date = new DateTime($date);
                                    echo date_format($date, 'F j, Y \a\t G:ia');
                                    ?>
                            </strong>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="my-3 alert alert-secondary">
                        No data for history at the moment. <a href="booking.php">Create booking here.</a>
                    </div>
                    <?php
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
include ('includes/footer.php');
?>