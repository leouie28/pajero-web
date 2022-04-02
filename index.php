<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>
<body>
   
    <?php
    include('includes/sidebar.php');
    ?>
<div class="main"> 
    <div class="header d-flex justify-content-start align-items-center">
        <button class="btn bar-btn">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="content p-3">

        <!-- <div class="card shadow">
            <div class="card-header">
                <h5>Booking form</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Pickup Place:</label>
                    <input type="text" name="" class="form-control" placeholder="Type specific location"/>
                    <hr>
                    <label>Destination Place:</label>
                    <input type="text" name="" class="form-control" placeholder="Type specific location"/>
                    <hr>
                    <label>Note: <span class="text-secondary">optional</span></label>
                    <textarea name="" placeholder="Additional information.." class="form-control" style="min-height: 120px;"></textarea>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-danger">Reset</button>
                        <button class="btn btn-info">Place Booking</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-footer">
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-info rounded-pill shadow-sm">Button 1</button>
                <button class="btn btn-info rounded-pill shadow-sm">Button 2</button>
                <button class="btn btn-info rounded-pill shadow-sm">Button 3</button>
            </div>
        </div> -->

        <!-- Page Content -->
<!-- <div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1>Simple Sidebar</h1>
        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens,
          the page content will be pushed off canvas.</p>
        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
      </div>
    </div>
  </div>
</div> -->
<!-- /#page-content-wrapper -->




<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">USERS</h5>
        <p class="card-text"><i class="fa fa-group"></i></p>
      </div>
      
    </div>
  </div>
  
  <div class="col">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">VEHICLES</h5>
        <p class="card-text"><i class="fa fa-car"></i></p>
      </div>
      
    </div>
  </div>


  <div class="col">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">DAILY BOOKING</h5>
        <p class="card-text"><i class="fa fa-table"></i></p>
      </div>
      
    </div>
  </div>


  
</div>





    </div>
</div>
<script src="asset/custom.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
    $("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
</script>

</body>
</html>