<?php
session_start();
if($_SESSION['type']=='passenger')
{
    include ('passenger-history.php');
}
elseif($_SESSION['type']=='driver')
{
    include ('driver-history.php');
}
?>