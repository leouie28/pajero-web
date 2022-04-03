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
            //change offer status
            $pajero = $_GET['pajero'];
            $bk = $_GET['booking'];
            $res ="UPDATE offer SET of_stat = 'accepted' WHERE of_id = $pajero";
            if($conn->query($res)===TRUE)
            {
                $bk = "UPDATE booking SET bk_stat = 'waiting' WHERE bk_id = $bk";
                if($conn->query($bk)===TRUE)
                {

                }
                else
                {
                    ?>
                    <script>
                        alert('Error on pajero request!');
                    </script>
                    <?php
                }
            }
            else
            {
                ?>
                <script>
                    alert('Error on pajero request!');
                </script>
                <?php
            }

            $sel = $conn->query("SELECT * FROM offer LEFT JOIN user ON offer.driver_id = user.user_id 
            WHERE of_id = $pajero");
            if($sel->num_rows>0)
            {
                $row = $sel->fetch_assoc();
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5><?= $row['user_fname']; ?> Pajero</h5>
                    </div>
                    <div class="card-body pajero-response">
                        <div class="text-center">
                            <h3 class="display-4 timer">2:00</h3>
                            <h5 class="my-2 mb-4 text-primary">Waiting for response..</h5>
                            <div class="progress">
                                <div class="progress-bar anim-loading progress-bar-striped progress-bar-animated" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" role="progressbar"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center mb-3">
                            <button class="btn btn-info change-pajero" disabled>Change pajero <i class="fa fa-refresh"></i></button>
                            <button class="btn btn-success arrive-btn">He's arrived <i class="fa fa-map-marker"></i></button>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> If the pajero did not <span class="res-war">response within 2 minutes</span>, the <strong>CHANGE PAJERO BUTTON</strong> will be abailable.
                        </div>
                    </div>
                </div>

                <script>

                    $('.change-pajero').click(function() {
                        $('.change-pajero-mdl').css('display','flex');
                    });
                    $('.arrive-btn').click(function() {
                        $('.arrive-mdl').css('display','flex');
                    });

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
                                $('.change-pajero').removeAttr('disabled');
                                $('.anim-loading').removeClass('anim-loading');
                            }
                        }, 1000);
                    }

                    var defTime = '2:00';
                    var swtch = 1;

                    $(document).ready(function() {
                        $('.anim-loading').attr('style','animation-duration: 120s !important');
                        $('.timer').text(defTime);
                        setTimeout(function() { 
                            countdown();
                        }, 2000);

                        setInterval(driveResponse, 5000);

                        function driveResponse() {

                            driver = '<?= $_GET['pajero']; ?>'
                            dr_res = 1;
                            dr_stat = 1;
                            if(swtch==1){
                                $.ajax({
                                    url: 'backend/backend-fetch.php',
                                    type: 'post',
                                    data: {
                                        driver: driver,
                                        dr_res: dr_res
                                    },
                                    success: function(res) {
                                        if(res == 1) {
                                            defTime = '<?= $row['of_time']; ?>:00';
                                            //defTime = '0:10';
                                            swtch = 0;
                                            $('.change-pajero').attr('disabled','');
                                            $('.anim-loading').removeClass('anim-loading');
                                            $('.progress-bar').css('width','0px');
                                            onTheWay();
                                        } else{
                                            //console.log('listening to database');
                                        }
                                    }
                                });
                            }
                        }

                        function onTheWay(){
                            nimDur = '<?= $row['of_time'] * 60; ?>';
                            //nimDur = '10';
                            $('.timer').text(defTime);
                            $('.pajero-response h5').text('Pajero is now ON THE WAY to pick you up..');
                            $('.pajero-response .alert .res-war').text('arrive within the specified time');
                            $('.progress-bar').addClass('anim-loading');
                            $('.anim-loading').attr('style','animation-duration: '+nimDur+'s !important');
                            setTimeout(function() { 
                                countdown();
                            }, 2000);
                        }
                    })
                </script>
                <?php
            }
            else
            {
                echo 'Invalid offer id';
            }
        }
        if(isset($_GET['arrive']))
        {
            $arrive = $_GET['arrive'];

            $sel = $conn->query("SELECT * FROM offer LEFT JOIN user ON offer.driver_id = user.user_id 
            WHERE of_id = $arrive");
            if($sel->num_rows>0)
            {
                $row = $sel->fetch_assoc();
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5><?= $row['user_fname']; ?> Pajero</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="my-2 mb-4 text-primary">You are now with <?= $row['user_fname']; ?> Pajero</h5>
                        </div>
                        <hr>
                        <div class="text-center mb-3">
                            <a href="home.php?completed=<?= $_GET['arrive']; ?>" class="btn btn-success">Mark as completed trip <i class="fa fa-check-circle"></i></a>
                        </div>
                        <!-- <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> If the pajero did not <span class="res-war">response within 2 minutes</span>, the <strong>CHANGE PAJERO BUTTON</strong> will be abailable.
                        </div> -->
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <div class="cus-modal change-pajero-mdl">
            <div class="card">
                <div class="card-header">
                    <h5>Change Pajero</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <h5>Are your sure you want to CHANGE PAJERO?</h5>
                    </div>
                    <div class="text-right mt-3">
                        <button class="btn-cl btn btn-secondary">Cancel</button>
                        <a href="waiting-booking.php?renew=<?= $_GET['pajero']; ?>" class="btn btn-info">Confirm & Change</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cus-modal arrive-mdl">
            <div class="card">
                <div class="card-header">
                    <h5>Pajero is arrive</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>CONFIRM PAJERO IS ARRIVED?</strong>
                    </div>
                    <div class="text-right mt-3">
                        <button class="btn-cl btn btn-secondary">Cancel</button>
                        <a href="waiting-pajero.php?arrive=<?= $_GET['pajero']; ?>" class="btn btn-success">Confirm</a>
                    </div>
                </div>
            </div>
        </div>

<?php
include ('includes/footer.php');
?>