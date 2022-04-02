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
                <h5>Vehicles 
                    <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#exampleModal">Add Vehicle</button>
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
                <!-- <th>Image</th> -->
                <th>Driver Name</th>
                <th>Plate No.</th>
                <th>Color</th>
                <th>Expiration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 
    $query="SELECT * from vehicle INNER JOIN user on vehicle.user_id = user.user_id ";
    $query_run=mysqli_query($conn,$query);

    if ($query_run) 
    {
         while ($row=mysqli_fetch_array($query_run)) 
        {

 ?>
            <tr>
                <td><?php echo $row['vh_id'] ?></td>
                <!-- <td><?php echo $row['vh_image'] ?></td> -->
                <td><?php echo $row['user_fname']." ".$row['user_lname'] ?></td>
                <td><?php echo $row['vh_plate'] ?></td>
                <td style="background-color:<?php echo $row['vh_color'];?>;"></td>
                <td><?php echo $row['vh_expire'] ?></td>
               
                <td><button class="btn bg-transparent" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['vh_id'] ?>"><i class="fa fa-edit"></i><span></span> </button>
                          </td>
                <?php 
                       include 'edit-vehicle.php';
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
        <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
       
      </div>
      <div class="modal-body">
        <form action="add-vehicle.php" method="POST">
            <div class="form-group">
                <label for="">Driver Name</label>
                <!-- <input class="form-control" type="text" placeholder="Search Name" name="driver_name" required> -->
                <div class="search-box">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Search Driver's First Name" name="driver"  />
                    <div class="result"></div>
                </div>
                <br>
                
                <label for="">Plate No.</label>
                <input class="form-control" type="text" placeholder="Enter Plate Number" name="plate_number" required>

                <label for="">Color</label>
                <input type="color" class="form-control" style="width: 150px;" name="color"/>


                <label for="">Expiration Date</label>
                <input class="form-control" type="date"  name="exp_date" required>

              
               


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


<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("user-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>



</body>
</html>