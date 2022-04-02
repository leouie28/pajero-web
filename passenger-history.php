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
                <h5>History</h5>
            </div>
            <div class="card-body p-2">
                <?php
                for($i=0; $i<=10; $i++)
                {
                    ?>
                    <div class="border rounded alert-secondary my-2 p-2">
                        <div class="row">
                            <div class="col">
                                From:<br>
                                <strong>Location</strong>
                            </div>
                            <div class="col">
                                Route:<br>
                                <strong>Location</strong>
                            </div>
                        </div>
                        <hr class="my-2">
                        Pajero: <strong>Driver name</strong><br>
                        Date: <strong>March 22, 2022 at 8:30 am</strong>
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