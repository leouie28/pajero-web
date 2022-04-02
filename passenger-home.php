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
                $id = $_SESSION['id'];
                $sel = $conn->query("SELECT * FROM booking WHERE passenger_id = $id AND bk_stat = 'searching'");
                if($sel->num_rows<0)
                {
                    while($row = $sel->fetch_assoc())
                    {
                        ?>
                        <div class="alert-secondary d-flex justify-content-between align-items-center border shadow-sm rounded" style="overflow: hidden;">
                            <div class="col-8">
                                Route:
                                <strong>Location</strong>
                            </div>
                            <div class="p-3 bg-info col-3">
                                <a href="waiting-booking.php?booking=<?= $row['bk_id']; ?>">
                                    <strong class="text-white">VIEW</strong>
                                </a>
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