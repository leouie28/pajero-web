<?php

require_once('includes/conn.php');
session_start();

    if(isset($_POST['submit']))
    {
    
      $type = mysqli_real_escape_string($conn,$_POST['type']);
      $fname= mysqli_real_escape_string($conn,$_POST['fname']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $address = mysqli_real_escape_string($conn,$_POST['address']);
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,md5($_POST['password']));
      $status = mysqli_real_escape_string($conn,$_POST['status']);


      $query = "insert into user (user_type,user_fname,user_lname,user_address,user_email,user_user,user_pass,user_stat)
       values ('$type','$fname','$lname','$address','$username','$email','$password','$status')";
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