<?php
session_start();
ob_start();
include ('../includes/conn.php');

if(isset($_POST['latest_bk']))
{
    $last = $_POST['last_id'];

    $sel = $conn->query("SELECT bk_id FROM booking WHERE bk_id > $last AND bk_stat = 'searching'");
    if($sel->num_rows>0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
if(isset($_POST['fetch_latest_bk']))
{
    $last = $_POST['last_id'];

    $sel = $conn->query("SELECT * FROM booking 
    LEFT JOIN user ON booking.passenger_id = user.user_id 
    WHERE booking.bk_id > $last AND bk_stat = 'searching'");
    if($sel->num_rows>0)
    {
        $row = $sel->fetch_assoc();
        $name = $row['user_fname'] . " " . $row['user_lname'];
        if($row['bk_type']=='standard')
        {
            $type = '<span class="badge badge-info">Standard</span>';
        }
        elseif($row['bk_type']=='special')
        {
            $type =  '<span class="badge badge-info">Special</span>';
        }
        ?>
        <div class="card mb-2 alert-secondary last-id" data-last="<?= $row['bk_id']; ?>">
            <div class="card-header p-2">
                <h6 class="m-0" style="font-size:18px;"> <?= $type . " " . $name; ?> <span class="badge badge-warning">new</span></h6>
            </div>
            <div class="card-body p-3">
                <div class="col">
                    <i class="fa fa-map-marker"></i> Pickup: <strong><?= $row['bk_from']; ?></strong>
                </div>
                <div class="col">
                    <i class="fa fa-location-arrow"></i> Destination: <strong><?= $row['bk_route']; ?></strong>
                </div>
                <div class="col">
                    <i class="fa fa-user"></i> Pax: <strong><?= $row['bk_pax']; ?></strong>
                </div>
                <div class="col">
                    <i class="fa fa-sticky-note"></i> Note: <?= $row['bk_note']; ?>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="text-primary">
                        <i class="fa fa-clock-o"></i> 
                        Posted: 
                        <?php
                        $time = $row['bk_update'];
                        $time = new DateTime($time);
                        $posted = $time->diff(new DateTime());
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
                        ?>
                    </div>
                    <button class="offer-btn btn btn-success btn-sm" data-id="<?= $row['bk_id']; ?>" data-user="<?= $name; ?>">OFFER SERVICE</button>
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="alert alert-info py-4">
            No available booking at the moment. <a href="">Refresh page</a>
        </div>
        <?php
    }
}
if(isset($_POST['search_from']))
{
    $from = $_POST['from'];

    $sel = $conn->query("SELECT pl_name FROM places WHERE pl_name LIKE '%$from%' LIMIT 10");
    if($sel->num_rows>0)
    {
        while($row = $sel->fetch_assoc())
        {
            ?>
            <option value="<?= $row['pl_name']; ?>">
            <?php
        }
    }
}

?>