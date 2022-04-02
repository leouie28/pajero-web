<div class="modal fade" id="update_modal<?php echo $row['user_id'] ?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="edit-user-process.php">
				<div class="modal-header">
		
    			<h3 class="modal-title">Update User</h3>
					
				</div>

                    <div class="modal-body">
                        
                            <div class="form-group">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">

                                <label for="">First Name</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="fname" value="<?php echo $row['user_fname'] ?>">

                                <label for="">Last Name</label>
                                <input class="form-control" type="text" placeholder="Enter Last Name" name="lname" value="<?php echo $row['user_lname'] ?>">

                                <label for="">Type</label>
                                <select class="form-control" name="type" >
                                    <option value="Driver">Driver</option>
                                    <option value="Passenger">Passenger</option>
                                </select>                

                                <label for="">Address</label>
                                <input class="form-control" type="text" placeholder="Enter Complete Address" name="address" value="<?php echo $row['user_address'] ?>">

                                <label for="">Username</label>
                                <input class="form-control" type="text" placeholder="Enter Username" name="username" value="<?php echo $row['user_user'] ?>">

                                <label for="">Email</label>
                                <input class="form-control" type="email" placeholder="Enter Email" name="email" value=" <?php echo $row['user_email'] ?>">

                                <label for="">Password</label>
                                <input class="form-control" type="password" placeholder="Enter Password" name="password" >

                               

                                


                            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
          <input type="submit" class="btn btn-primary" name="submit" value="Save">
      </div>
      </form>
				</div>
			</form>
		</div>
	</div>
</div>
