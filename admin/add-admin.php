            <?php include('partials/menu.php');?>
            <div class="main-content">
                <div class="wrapper">
                    <h1>Add Admin</h1>
                    <br><br>

                    <?php
                      if(isset($_SESSION['add']))//whether session is added
                      {
                         echo $_SESSION['add'];//displaying session
                         unset($_SESSION['add']);//removing session
                      }
                    ?>
                    <form action="" method="POST">
                        <table class="tbl-30">
                            <tr>
                                <td>Full Name: </td>
                                <td><input type="text" name="full_name" placholder="Enter Your Name"></td>
                            
                            </tr>
                            <tr>
                                <td>Username: </td>
                                <td><input type="text" name="username" placholder="Enter Your Username"/></td>
                            
                            </tr>
                            <tr>
                                <td>Password: </td>
                                <td><input type="password" name="password" placholder="Enter Your Password"/></td>
                            
                            </tr>
                            <tr>
                                <td colspan="2">

                                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>




            <!-- footer Section -->
            <?php 
                include('partials/footer.php');
                ?>


        <?php
            
            if(isset($_POST['submit']))
            {
               $full_name=$_POST['full_name'];
                $username=$_POST['username'];
                $password=md5($_POST['password']);//password encryption

                //database

                $sql = "insert into tbl_admin set
                    full_name='$full_name',
                    username='$username',
                    password='$password'
                
                ";


                               
                //execute query and save data
                
                
                

                //executing query and saving data in base

                $res = mysqli_query($conn,$sql) or die(mysqli_error());

                // check wether data is inserted

                if($res==TRUE)
                {
                    //data inserted
                    //echo "data inserted";
                    //create a session variable to display message
                    $_SESSION['add'] = "Admin added Successfully";
                    //redirect page to admin
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    //fail
                    //echo "fail";
                    $_SESSION['add'] = "Failed to add data";
                    //redirect page to add admin
                    header("location:".SITEURL.'admin/add-admin.php');
                }

            }
        

        ?>