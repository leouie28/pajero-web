<?php

require_once('includes/conn.php');
session_start();


    if(isset($_POST['submit']))
    {
       // $user_name = $_POST['driver'];
        $plate_number = mysqli_real_escape_string($conn,$_POST['plate_number']);
        $color = mysqli_real_escape_string($conn,$_POST['color']);
        $exp_date = $_POST['exp_date'];
        $vh_id = $_POST['vh_id'];

        $user_id="";	////user ID
        $values = mysqli_real_escape_string($conn,$_POST['driver']);
        $stripped = str_replace(' ', '', $values);
    	
     	////query to get ID of customer
    	$query = "select * from user where concat(user_fname,user_lname)  like '%$stripped%'  ";
        $query_run = mysqli_query($conn,$query);
         if ($query_run) 
         {
             while ($row=mysqli_fetch_array($query_run)) 
             {
                 $user_id .= $row['user_id'];
                 
             }

         }

         $query = "update vehicle set user_id='$user_id',vh_plate='$plate_number',vh_color='$color',vh_expire='$exp_date' where vh_id ='$vh_id' ";
         $query_run= mysqli_query($conn,$query);
  
                              if($query_run)
                              {
                                  $_SESSION['status'] = "Data saved successfully!";
                                  $_SESSION['status_code']="success"; 
                                  header("location:vehicle.php");
  
                                  
                              }
                              else
                              {
                                  $_SESSION['status'] = "Data saving Failed!";
                                  $_SESSION['status_code']="error"; 
                                  header("location:vehicle.php");
  
                              
                              }
        




    }
?>