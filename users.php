<?php
    session_start();
    require_once('includes/conn.php');

?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>
<body>

<?php 
    include('includes/sidebar.php');
    ?>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar-btn" class="btn btn-default" id="menu-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="content p-3">

        <div class="card shadow">
            <div class="card-header">
                <h5>Users 
                    <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#exampleModal">Add User</button>
                </h5>
                <br>
                <?php
                    include('alert.php');
                ?>
            </div>
            <br>
           
            <table id="example" class="table table-striped table-bordered " style="width:100%; ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Address</th>
                <th>Email</th>
                <th>Username</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 
    $query="select * from user ";
    $query_run=mysqli_query($conn,$query);

    if ($query_run) 
    {
         while ($row=mysqli_fetch_array($query_run)) 
        {

 ?>
            <tr>
                <td><?php echo $row['user_id'] ?></td>
                <td><?php echo $row['user_fname']." ".$row['user_lname'] ?></td>
                <td><?php echo $row['user_type'] ?></td>
                <td><?php echo $row['user_address'] ?></td>
                <td><?php echo $row['user_user'] ?></td>
                <td><?php echo $row['user_email'] ?></td>
                <td>
                    
                <?php 
                    if($row['user_stat']=='Active')
                    {
                     
                        echo  "<a href=deactivate-user.php?id=".$row['user_id']." class='btn btn-success btn-sm'>Active</a>";
                    }
                    else
                    {
                        echo  "<a href=activate-user.php?id=".$row['user_id']." class='btn btn-danger btn-sm'>Inactive</a>";
             
                    }
                    
                ?>
            
            
                </td>
                <td><button class="btn bg-transparent" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['user_id'] ?>"><i class="fa fa-edit"></i><span></span> </button>
                          </td>
                <?php 
                       include 'edit-user.php';
        }
    }
?>
            </tr>
            
            
        </tbody>
       
    </table>
            
            

        </div>

        
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
       
      </div>
      <div class="modal-body">
        <form action="add-user.php" method="POST">
            <div class="form-group">
                <label for="">First Name</label>
                <input class="form-control" type="text" placeholder="Enter Name" name="fname" required>

                <label for="">Last Name</label>
                <input class="form-control" type="text" placeholder="Enter Last Name" name="lname" required>

                <label for="">Type</label>
                <select class="form-control" name="type" >
                    <option value="Driver">Driver</option>
                    <option value="Passenger">Passenger</option>
                </select>                

                <label for="">Address</label>
                <input class="form-control" type="text" placeholder="Enter Complete Address" name="address" required>

                <label for="">Username</label>
                <input class="form-control" type="text" placeholder="Enter Username" name="username"required>

                <label for="">Email</label>
                <input class="form-control" type="email" placeholder="Enter Email" name="email"required>

                <label for="">Password</label>
                <input class="form-control" type="password" placeholder="Enter Password" name="password"required>

                <label for="">Status: </label>
              
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="defaultInline1" name="status" value="Active">
                <label class="custom-control-label" for="defaultInline1">Active</label>
                </div>

                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="defaultInline2" name="status" value="Inactive">
                <label class="custom-control-label" for="defaultInline2">Inactive</label>
                </div>


            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
           <input type="submit" class="btn btn-primary" name="submit" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        fixedHeader: true
    } );
} );
</script>

</body>
</html>