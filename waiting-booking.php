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
    <div class="content p-3">

        <div class="card shadow">
            <div class="card-header">
                <h5>Waiting booking</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <h6 class="mt-3">Waiting for driver to send offer..</h6>
                </div>
                <hr>
                <!-- Create another fetch div with incrementing number -->
                <div class="offer-res">
                    <div class="fetch0">
                        <div class="alert alert-warning id" data-id="0">
                            Your booking is now in search! Driver/s will send offer to your booking and need to to be accepted.
                        </div>
                    </div>
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
            $(document).ready(function() {

                var count = 0;

                setInterval(getOffers, 5000);

                function getOffers(){

                    last = $('.fetch'+count+' .id').data('id');
                    bk = <?= $_GET['booking']; ?>;
                    get_offers = 1;
                    $.ajax({
                        url: 'backend/backend-fetch.php',
                        type: 'post',
                        data: {
                            bk: bk,
                            last: last,
                            get_offers: get_offers
                        },
                        success: function(res) {
                            if(res == 1) {
                                console.log('fetching');
                                count = count + 1;
                                if(count>=1){
                                    $('.fetch0').css('display','none');
                                }
                                fetch_offers = 1;
                                $('.offer-res').append('<div class="fetch'+count+'"></div>');
                                $.ajax({
                                    url:'backend/backend-fetch.php',
                                    type: 'post',
                                    data: {
                                        bk: bk,
                                        last: last,
                                        fetch_offers: fetch_offers
                                    },
                                    success: function(html) {
                                        $('.fetch'+count).html(html);
                                    }
                                });
                            } else{
                                console.log('listening to database');
                            }
                        }
                    });
                }
            });
        </script>

<?php
include ('includes/footer.php');
?>