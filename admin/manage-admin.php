
   <?php
   include('partials/menu.php');
   ?>

      <!-- Main Content Section -->
      <div class="main-content">
      <div class="wrapper">
            <h1>Manage Admin Page</h1>
            <br>

            <!-- Button to add admin -->

            <?php
            if(isset($_SESSION['add']))
            {
               echo $_SESSION['add'];//displaying session
               unset($_SESSION['add']);//removing session
            }
            if(isset($_SESSION['delete']))
            {
               echo $_SESSION['delete'];
               unset( $_SESSION['delete']); 
            }

            if(isset($_SESSION['update']))
            {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
               echo $_SESSION['user-not-found'];
               unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['pwd-not-match']))
            {
               echo $_SESSION['pwd-not-match'];
               unset($_SESSION['pwd-not-match']);
            }
            if(isset($_SESSION['change-pwd']))
            {
               echo $_SESSION['change-pwd'];
               unset($_SESSION['change-pwd']);
            }
            ?>
            <br><br>
               
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br><br>


            
            <table class="tbl-full">
               <tr>
                     <th>SNo</th>
                     <th>Full Name</th>
                     <th>Username</th>
                     <th>Actions</th>
               </tr>

               <?php
                  //query to get all admin
                  $sql = "SELECT * from tbl_admin";
                  //execute the query
                  $res = mysqli_query($conn, $sql);

                  //check whether the query is executed of not

                  if($res == TRUE)
                  {
                     // count rows to check whether we have database or not
                     $count = mysqli_num_rows($res);

                     // check the num of rows
                     if($count>0)
                     {
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                           //using while looop to get all the data from database
                           //And while loop will run as long as we have data in database
                           //get indivisual data
                           $id = $rows['id'];
                           $full_name=$rows['full_name'];
                           $username=$rows['username'];

                           //display the values in our table

                           ?>



                           <tr>
                              <td><?php echo $id; ?></td>
                              <td><?php echo $full_name?></td>
                              <td><?php echo $username?></td>
                              <td>
                                 <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                 <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                 <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                 
                              </td>
                           </tr>


                           <?php
                        }
                     }
                     else{
                        //we do not have new data in database
                     }
                  }

               ?>

              
            </table>

         </div>
      </div>



      <!-- footer Section -->
      <?php 
      include('partials/footer.php');
      ?>
