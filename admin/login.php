<?php
    include('../config/constants.php');
    ?>


<html>

    <head>
        <title>
            Login - Food Order System
        </title>
        <link rel="stylesheet" href="../css/admin1.css">
        
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br> <br>


            <!-- Logim form start -->
            <form action="" method="POST" class="text-center">

                Username: <br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter the password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login end -->


            <p class="text-center">Created By - <a href="www.google.com">Surya Veer</a></p>
        </div>
    </body>
</html>



<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //proceed for login
        //1. Get the data from login form
        $username=$_POST['username'];
        $password = md5($_POST['password']);

        //2.SQL to check whether the user exist or not
        $sql="select * from tbl_admin where username='$username' and password='$password'";

        //3. execute the query
        $res=mysqli_query($conn,$sql);


        //4.Count rows to check whether user exist or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and login success
            $_SESSION['login']="<div class='success'>Login Successfull.</div>";
            $_SESSION['user'] = $username;//To check whether user is log in or not and logout will unset it

            //redirect to home/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available
            //User Available and login failiure
            $_SESSION['login']="<div class='error text-center'>Login Unsuccessfull.</div>";
            //redirect to home/dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }


?>

