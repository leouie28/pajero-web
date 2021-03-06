<?php
session_start();
ob_start();
include ('../includes/conn.php');

//listen if there is offer to the booking
if(isset($_POST['get_offers']))
{
    $bk = $_POST['bk'];
    $last = $_POST['last'];

    $sel = $conn->query("SELECT of_id FROM offer WHERE of_id > $last AND bk_id = $bk AND of_stat = 'pending'");
    if($sel->num_rows>0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}
//fetch offers for the booking
if(isset($_POST['fetch_offers']))
{
    $bk = $_POST['bk'];
    $last = $_POST['last'];

    $sel = $conn->query("SELECT * FROM offer 
    LEFT JOIN user ON offer.driver_id = user.user_id 
    WHERE of_id > $last AND bk_id = $bk AND of_stat = 'pending'");
    if($sel->num_rows>0)
    {
        $row = $sel->fetch_assoc();
        $driver = $row['user_fname'] . " " . $row['user_lname'];
        ?>
        <div class="alert alert-primary id" data-id="<?= $row['of_id']; ?>">
            <strong><?= $driver; ?> send an offer:</strong><br>
            <?= $row['of_message']; ?><br>
            <span class="badge badge-warning">I'll be there in <?= $row['of_time']; ?> minutes or less</span>
            <div class="d-flex justify-content-between mt-2">
                <div class="text-primary">
                    <i class="fa fa-clock-o"></i> 
                    Sent 
                    <?php
                    $sent = $row['of_update'];
                    $sent = new DateTime($sent);
                    $posted = $sent->diff(new DateTime());
                    if($posted->d>=1)
                    {
                        echo $posted->d . ' day ago';
                    }
                    elseif($posted->h>=1)
                    {
                        echo $posted->h . ' hr ago';
                    }
                    elseif($posted->i>=1)
                    {
                        echo $posted->i . ' m ago';
                    }
                    elseif($posted->s>=1)
                    {
                        echo $posted->s . ' s ago';
                    }
                    ?>
                </div>
                <button class="acpt-btn btn btn-success btn-sm" 
                data-id="<?= $row['of_id']; ?>" 
                data-bk="<?= $row['bk_id']; ?>"
                data-driver="<?= $driver; ?>" 
                data-time="<?= $row['of_time']; ?>">Accept offer <i class="fa fa-check-circle"></i></button>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="cus-modal acpt-modal">
        <div class="card">
            <div class="card-header">
                <h5><span class="driver">Driver</span> Offer</h5>
            </div>
            <div class="card-body">
               <div class="alert alert-primary">
                    <strong>Accept <span class="driver"></span> offer?</strong><br>
                    His offer will pick you up in <span class="time">time</span> minutes or less.
               </div>
               <hr>
               <div class="text-right">
                    <button class="btn-cl btn btn-secondary">Close</button>
                    <a href="" class="btn btn-success">Confirm offer <i class="fa fa-check-circle"></i></a>
               </div>
            </div>
        </div>
    </div>
    <script>
        $('.btn-cl').click(function() {
            $('.cus-modal').css('display','none');
        });
        $('.acpt-btn').click(function() {
            id = $(this).data('id');
            bk = $(this).data('bk');
            link = 'waiting-pajero.php?pajero='+id+'&booking='+bk;
            driver = $(this).data('driver');
            time = $(this).data('time');
            $('.acpt-modal').css('display','flex');
            $('.acpt-modal .card .driver').text(driver);
            $('.acpt-modal .card .time').text(time);
            $('.acpt-modal .card a').attr('href',link);
        });
    </script>
    <?php
}
if(isset($_POST['dr_res']))
{
    $pajero = $_POST['driver'];

    $sel = $conn->query("SELECT of_stat FROM offer WHERE of_id = $pajero");
    if($sel->num_rows>0)
    {
        $row = $sel->fetch_assoc();
        if($row['of_stat']=='otw')
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}
if(isset($_POST['fetch_accepted']))
{
    $driver = $_POST['driver'];
    $sel = $conn->query("SELECT * FROM offer 
    LEFT JOIN booking ON offer.bk_id = booking.bk_id 
    LEFT JOIN user ON booking.passenger_id = user.user_id 
    WHERE offer.of_stat = 'accepted' AND offer.driver_id = $driver");
    if($sel->num_rows>0)
    {
        $row = $sel->fetch_assoc();
        ?>
        <div class="cus-modal last-id" data-id="0" style="display: flex;">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong><?= $row['user_fname']; ?> accepted your offer!</strong><br>
                        This passenger is now waiting for your response. <br>
                    </div>
                    <div class="text-right">
                        <a href="../pajero/booking-list.php?cancel=<?= $row['of_id']; ?>" class="btn btn-danger">Cancel Offer</a>
                        <a href="../pajero/booking-list.php?pickup=<?= $row['of_id']; ?>" class="btn btn-info">Pick up now</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="cus-modal last-id" data-id="1"></div>
        <?php
    }
}
?>