<?php

require_once('includes/conn.php');



if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM user where user_stat='Active' AND user_type='Driver' AND user_fname  LIKE ?   ";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["user_fname"] ." ".$row["user_lname"]. "</p>";
                }
            } else{
                echo '<a href="users.php">
                <p class="list-group-item border-1">No Record Found! Click here to add New Driver</p>
              </a>';
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($conn);
?>
