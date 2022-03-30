<?php
session_start();
ob_start();
include ('../includes/conn.php');

//Creating offer to the passenger booking
if(isset($_POST['offer-btn']))
{
    $driver = $_SESSION['id'];
    $bk = $_POST['bk'];
    $msg = $_POST['msg'];
    $time2Go = $_POST['time'];
    $date = date('Y-m-d');
    $stat = 'pending';
    $time = date('Y-m-d H:i:s');

    $ins = "INSERT INTO offer (driver_id, bk_id, of_stat, of_message, of_time, of_create, of_update) 
    VALUE ($driver, $bk, '$stat', '$msg', '$time2Go', '$date', '$time')";
    if($conn->query($ins)===TRUE)
    {
        $_SESSION['res'] = "<div class='alert alert-success shadow'>Offer submit successfully.</div>";
        header('location:../booking-list.php');
    }
    else
    {
        $_SESSION['res'] = "<div class='alert alert-danger shadow'>Offer failed to submit! Please try again.</div>";
        header('location:../booking-list.php');
    }
}
?>