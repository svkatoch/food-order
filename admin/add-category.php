<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>


        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br><br>

        <!-- add category form -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>


                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

        <!-- Form ENds -->
        <?php

        //check whether the submit button is clicked
        if (isset($_POST['submit'])) {
            //1. Get the value from category form
            $title = $_POST['title'];
            // for radio inout we need to chek whether the button is selectd or not
            if (isset($_POST['featured'])) {
                //get the value from form
                $featured = $_POST['featured'];
            } else {
                //default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            //check whether image selected or not and set the value from image accordingly


            //print_r($_FILES['image']);
           // die();//Break the code here
            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name,source path and destination path
                $image_name = $_FILES['image']['name'];

                $ext = end(explode('.',$image_name));

                //rename the image
                $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                //finally upload the image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the imahe is uploaded or not
                //and if the image is not uploaded then eill stop the process and redirect it
                if($upload==false)
                {
                    //SET message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    //redirect to add category
                    header('loaction:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }
            }
            else{
                //dont upload image
                $image_name="";
            }

            //2.Create SQL query to nisert the category into database
            $sql = "INSERT INTO tbl_category set title='$title',
            image_name='$image_name',
                feature = '$featured',
                active='$active'
                ";
            //3. Execute the query and save in database
            $res = mysqli_query($conn, $sql);
            //4.check whether the query executed or not
            if ($res == true) {
                //Query executed and category added
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                //rediect to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //Failed to add category
                $_SESSION['add'] = "<div class='error'>Failed</div>";
                //rediect to manage category
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }

        ?>

    </div>

<?php include('partials/footer.php'); ?>