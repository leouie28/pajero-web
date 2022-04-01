<?php
session_start();
if($_SESSION['type']=='passenger')
{
    include ('passenger-home.php');
}
elseif($_SESSION['type']=='driver')
{
    include ('driver-home.php');
}
?>