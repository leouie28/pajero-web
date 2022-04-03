<?php
ob_start();
$act[0] = 'active';
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
                <h5>Dashboard</h5>
            </div>
            <div class="card-body">
                <div id="chart_wrap">
                    <div id="donutchart"></div>
                </div>
                <hr>
                <div class="alert alert-warning">
                    Your pajero will expire on <strong>March 10, 2022.</strong> 
                    Please renew your registration before the expiration date.
                </div>
            </div>
        </div>

        <?php
        $completed = 0;
        $pending = 0;
        $other = 0;
        $driver = $_SESSION['id'];
        $sel = $conn->query("SELECT booking.driver_id AS user, offer.of_id AS num FROM offer 
        LEFT JOIN booking ON offer.bk_id = booking.bk_id 
        WHERE offer.driver_id = $driver");
        if($sel->num_rows>0)
        {
            while($row = $sel->fetch_assoc())
            {
                if(!empty($row['user']))
                {
                    if($row['user']!=$driver)
                    {
                        $other = $other + 1;
                    }
                    else
                    {
                        $completed = $completed + 1;
                    }
                }
                else
                {
                    $pending = $pending + 1;
                }
            }
        }
        else
        {

        }
        $total = $completed + $pending + $other;
        ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        $(window).on("throttledresize", function (event) {
            var options = {
                width: '100%',
                height: '100%'
            };

            var data = google.visualization.arrayToDataTable([]);
            drawChart(data, options);
        });
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Activity', 'Engage to booking'],
            ['Completed',     <?= $completed; ?>],
            ['Pending',      <?= $pending; ?>],
            ['Take by other',  <?= $other; ?>]
            ]);

            var options = {
            title: 'Trip Activities',
            <?php
            if($total>1)
            {
                echo 'pieHole: 0.3';
            }
            else
            {
                echo 'pieHole: 0';
            }
            ?>,
            legend: {
                position: 'top',
                maxLines: 2
            },
            pieSliceText: 'value-and-percentage',
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
        </script>
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