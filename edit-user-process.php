<?php

require_once('includes/conn.php');
session_start();

    if(isset($_POST['submit']))
    {
    
      $user_id = $_POST['user_id'];
      $type = mysqli_real_escape_string($conn,$_POST['type']);
      $fname= mysqli_real_escape_string($conn,$_POST['fname']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $address = mysqli_real_escape_string($conn,$_POST['address']);
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    //  $status = mysqli_real_escape_string($conn,$_POST['status']);

   		
    if($_POST['password']!=null)
    {
      $query = "update user set user_type='$type',user_fname='$fname',user_lname='$lname',user_address='$address',user_email='$email',user_user='$username',user_pass='$password' where user_id='$user_id' ";
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
    else
    {
      $query = "update user set user_type='$type',user_fname='$fname',user_lname='$lname',user_address='$address',user_email='$email',user_user='$username' where user_id='$user_id' ";
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
      
    }

?>