<div class="modal fade" id="update_modal<?php echo $row['vh_id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle</h5>
       
      </div>
      <div class="modal-body">
        <form action="edit-vehicle-process.php" method="POST">
          <input type="hidden" name="vh_id"value=" <?php echo $row['vh_id']; ?> ">
            <div class="form-group">
                <label for="">Driver Name</label>
                <div class="search-box">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Search Driver's First Name" name="driver" value="<?php echo $row['user_fname']." ".$row['user_lname'] ?>"  />
                    <div class="result"></div>
                </div>
                <br>
                
                <label for="">Plate No.</label>
                <input class="form-control" type="text" placeholder="Enter Plate Number" name="plate_number" value="<?php echo $row['vh_plate'] ?>" >

                <label for="">Color</label>
                <input type="color" class="form-control" style="width: 150px;" value="<?php echo $row['vh_color'] ?>" name="color"/>


                <label for="">Expiration Date: </label>
                <input class="form-control" type="date"  name="exp_date" value="<?php echo $row['vh_expire']; ?>" >

              
               


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