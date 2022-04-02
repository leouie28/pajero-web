<?php
require_once('includes/conn.php');
session_start();
	// Check if id is set or not if true toggle,
	// else simply go back to the page
	if (isset($_GET['id'])){

        $user_id= $_GET['id'];
		$query = "update user set user_stat='Active' where user_id='$user_id' ";
	    $query_run= mysqli_query($conn,$query);

							if($query_run)
							{
								$_SESSION['status'] = "Data saved successfully!";
				        		$_SESSION['status_code']="success"; 
				        		header("location:users.php");
							}
							else
							{
								$_SESSION['status'] = "Data saving Failed!";
				        		$_SESSION['status_code']="error"; 
				        		header("location:users.php");

							}
	}

	
?>
