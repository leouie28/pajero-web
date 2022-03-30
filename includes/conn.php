<?php
$Server = "127.0.0.1";//serverhost
$Uname = "root";
$UPass = "";
$db = "pajero";// database name

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = mysqli_connect($Server,$Uname,$UPass,$db);

if(!$conn)
{
	?>
	<div class="alert alert-danger">
	  <strong>Error!</strong> 
	  <?php
	  die("No connection to Database: " . mysqli_connect_error());
	  ?>
	</div>
	<?php
}

?>