<?php
    //include constantns.php file
    include('../config/constants.php');
    // get the id of admin to be deleted

     $id = $_GET['id'];


    //create sql query to delete the admin
    $sql = "delete from tbl_admin where id=$id";

    //execute it
    $res = mysqli_query($conn,$sql);
    //chech whether the query is executed successfuly
    if($res==TRUE)
    {
        //query executed(admin deleted)
        //echo "Admin deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Admin not deleted";
        //failed to delete admin
        $_SESSION['delete']="<div class='error'>Failed to delete.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //redirect to the manage admin page with message"Success" or "error"

?>