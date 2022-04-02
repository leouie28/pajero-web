<center>
                                <?php      
                        if(isset($_SESSION['status']))
                        {
                           
                                  if ($_SESSION['status']=="Data saved successfully!") 
                            {
   

                           ?>
                               <div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong><?php echo $_SESSION["status"]; ?></strong> 
                                </div>

                           <?php 
                            unset($_SESSION['status']);
                            }

                            else
                            {
                            ?>
   
                            <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong><?php echo $_SESSION["status"]; ?></strong> 
                                </div>

                           <?php 
                            unset($_SESSION['status']);

                            }

                        }
                         ?>
</center>
