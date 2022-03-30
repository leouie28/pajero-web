<?php
ob_start();
$id = 123;
header('location:booking.php?booking=' . $id );
?>