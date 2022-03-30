<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>
<body>
<div class="sidenav">
    <div class="avatar">
        <div class="avatar-img">
            <!-- <img src="" alt=""> -->
            <i class="fa fa-user-circle"></i>
        </div>
        <h6><span class="badge badge-secondary">@user</span></h6>
    </div>
    <hr>
    <?php
    include('includes/sidebar.php');
    ?>
</div>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar-btn">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="content p-3">

        <div class="card shadow">
            <div class="card-header">
                <h5>Users 
                    <button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#exampleModal">Add User</button>
                </h5>
                         </div>
            <br>
           
            <table id="example" class="table table-striped table-bordered " style="width:100%; ">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
       
      </div>
      <div class="modal-body">
        <form action="">
            <div class="form-group">
                <label for="">First Name</label>
                <input class="form-control" type="text" placeholder="Enter Name" name="fname">

                <label for="">Last Name</label>
                <input class="form-control" type="text" placeholder="Enter Last Name" name="lname">

                <label for="">Type</label>
                <select class="form-control" name="type" id="">
                    <option value="Passenger">Passenger</option>
                    <option value="Driver">Driver</option>
                </select>                

                <label for="">Address</label>
                <input class="form-control" type="text" placeholder="Enter Complete Address" name="address">

                <label for="">Username</label>
                <input class="form-control" type="text" placeholder="Enter Username" name="username">

                <label for="">Email</label>
                <input class="form-control" type="email" placeholder="Enter Email" name="email">

                <label for="">Password</label>
                <input class="form-control" type="password" placeholder="Enter Password" name="password">

                <label for="">Type</label>
                <select class="form-control" name="status" id="">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>   


            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
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