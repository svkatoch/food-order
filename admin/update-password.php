<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>




        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }        
        ?>







        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>

                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr> 
            <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input class="btn-secondary" type="submit" name="submit" value="Change Password">
                </td>
            </tr>

        </table>

        </form>
    </div>
</div>


<?php 

            //check whether the submit button is clicked
            if(isset($_POST['submit']))
            {
                //echo "Clicked";


                //1. Get the data from form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password=md5($_POST['new_password']);
                $confirm_password=md5($_POST['confirm_password']);

                //2. Check whether user with current id and pass exist or not

                $sql="SELECT * from tbl_admin where id=$id and password = '$current_password'";
                //execute the query
                $res= mysqli_query($conn,$sql);

                if($res==true)
                {
                    //check whether data is available
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        //user exist
                        //check whether new pass and confirm pass match
                        if($new_password==$confirm_password)
                        {
                            //update the pass
                            //echo "Password matched";
                            $sql2="UPDATE tbl_admin set password='$new_password'
                            where id=$id";

                            $res2=mysqli_query($conn,$sql2);

                            //check whether the query executed or not

                            if($res2==true)
                            {
                                //display the success message
                                $_SESSION['change-pwd']="<div class='success'>User password changed</div>"; 
                                //redirect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //display error
                                $_SESSION['change-pwd']="<div class='error'>Failed to change password</div>";
                                //redirect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');

                            }
                        }
                        else
                        {
                            //redirect to manage admin pag with error message
                            $_SESSION['pwd-not-match']="<div class='error'>Password did not match</div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        //user does not exist
                        $_SESSION['user-not-found']="<div class='error'>User not found</div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //3. Check whether the new password and confirm pass is same

                //4.Change password.
            }

?>

<?php 
    include('partials/footer.php');
    ?>