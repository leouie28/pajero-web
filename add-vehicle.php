<?php

require_once('includes/conn.php');
session_start();


    if(isset($_POST['submit']))
    {
       // $user_name = $_POST['driver'];
        $plate_number = mysqli_real_escape_string($conn,$_POST['plate_number']);
        $color = mysqli_real_escape_string($conn,$_POST['color']);
        $exp_date = $_POST['exp_date'];
        

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

         $query = "insert into vehicle (user_id,vh_plate,vh_color,vh_expire)
         values ('$user_id','$plate_number','$color','$exp_date')";
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