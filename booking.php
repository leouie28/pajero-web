<?php
session_start();
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

        <?php
        if(isset($_POST['book']))
        {
            $user = $_SESSION['id'];
            $from = $_POST['from'];
            $route = $_POST['route'];
            $type = $_POST['type'];
            $pax = $_POST['pax'];
            $note = $_POST['note'];
            $stat = 'searching';
            $date = date('Y-m-d');
            $time = date('Y-m-d H:i:s');

            $ins = "INSERT INTO booking (passenger_id, bk_type, bk_from, bk_route, bk_pax, bk_note, bk_stat, bk_create, bk_update) 
            VALUE ($user, '$type', '$from', '$route', $pax, '$note', '$stat', '$date', '$time')";
            if($conn->query($ins)===TRUE)
            {
                $sel = $conn->query("SELECT bk_id FROM booking WHERE passenger_id = $user ORDER BY bk_id DESC");
                if($sel->num_rows>0)
                {
                    $row = $sel->fetch_assoc();
                    header('location:waiting-booking.php?booking=' . $row['bk_id'] );
                }
                else
                {
                    header('location:waiting-booking.php');
                }
            }
            else
            {
                ?>
                <div class="alert alert-danger">
                    Failed to post bookin! Please try again
                </div>
                <?php
            }
        }
        ?>

        <div class="card shadow">
            <div class="card-header">
                <h5>Booking form</h5>
            </div>
            <div class="card-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label>Pickup Place:</label>
                        <input type="text" name="from" class="form-control" placeholder="Type specific location"/>
                        <label>Destination Place:</label>
                        <input type="text" name="route" class="form-control" placeholder="Type specific location"/>
                        <hr>
                        <div class="form-row" style="flex-wrap:nowrap;">
                            <div class="form-group col-sm-6">
                                <label>Book Type:</label>
                                <select name="type" class="form-control">
                                    <option value="standard">Standard</option>
                                    <option value="special">Special</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Pax:</label>
                                <input type="number" name="pax" class="form-control" value="1" min="1"/>
                            </div>
                        </div>
                        <label>Note: <span class="text-secondary">optional</span></label>
                        <textarea name="note" placeholder="Additional information.." class="form-control" style="min-height: 100px;"></textarea>
                        <hr>
                        <div class="text-right">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" name="book" class="btn btn-info">Post Booking</button>
                        </div>
                    </div>
                </form>
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