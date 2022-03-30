<?php
session_start();
ob_start();
$act = array();
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
    <div class="content p-3 d-flex justify-content-center align-items-center" style="min-height: 90vh;">

        <?php
        if(isset($_GET['pajero']))
        {

        }
        ?>

        <div class="card shadow">
            <div class="card-header">
                <h5>Waiting Pajero</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h3 class="display-4 timer">2:00</h3>
                    <h5 class="my-2 mb-4 text-primary">Waiting for response..</h5>
                    <div class="progress">
                        <div class="progress-bar anim-loading progress-bar-striped progress-bar-animated" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" role="progressbar"></div>
                    </div>
                </div>
                <hr>
                <div class="text-center mb-3">
                    <button class="btn btn-info" disabled>Change pajero <i class="fa fa-refresh"></i></button>
                    <button class="btn btn-success" disabled>He's arrived <i class="fa fa-map-marker"></i></button>
                </div>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> If the pajero did not response within 2 minutes, we will ask you to <strong>WAIT or CHANGE</strong> Pajero.
                </div>
            </div>
        </div>

        <div class="cus-modal" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h5>Waiting booking</h5>
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

        <script>
            var interval;

            function countdown() {
            clearInterval(interval);
            interval = setInterval( function() {
                var timer = $('.timer').html();
                timer = timer.split(':');
                var minutes = timer[0];
                var seconds = timer[1];
                seconds -= 1;
                if (minutes < 0) return;
                else if (seconds < 0 && minutes != 0) {
                    minutes -= 1;
                    seconds = 59;
                }
                else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

                $('.timer').html(minutes + ':' + seconds);

                if (minutes == 0 && seconds == 0){
                    clearInterval(interval);
                    $('.btn').removeAttr('disabled');
                    console.log('done timer');
                }
            }, 1000);
            }

            $(document).ready(function() {
                $('.timer').text("2:00");
                setTimeout(function() { 
                    countdown();
                }, 2000);
            })
        </script>

<?php
include ('includes/footer.php');
?>