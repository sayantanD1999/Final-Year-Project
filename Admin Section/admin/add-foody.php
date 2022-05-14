<?php
    include('partials/menu.php');
    ob_start();
?>










<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <?php

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);

            }


        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="food" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>
                        Author:
                    </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td>
                    <select name="user">
                        <?php 
                            //create php code to display categories from database
                            //1. create sql to get all active categories from database
                            $sql="select * from tbl_user";
                            //executing query
                            $res=mysqli_query($conn,$sql);
                            //count the rows to check whether we havecategories or not
                            $count=mysqli_num_rows($res);

                            //if count is greater than 0,we have categories else we don't have categories
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $user_id=$row['user_id'];
                                    $user_userid=$row['user_userid'];
                                    $user_name=$row['user_name'];

                                    ?>
                                    
                                    <option value="<?php echo $user_id; ?>"><?php echo $user_name;?></option>

                                    <?php
                                }
                            }
                            else{
                                //we don't  have user

                                ?>
                                <option value="0">No User Found</option>
                                <?php
                            }
                            //2.display on Description
                        ?>
                            
                    </select>
                    </td>

                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                    <select name="category">
                        <?php 
                            //create php code to display categories from database
                            //1. create sql to get all active categories from database
                            $sql="select * from tbl_category where active='Yes'";
                            //executing query
                            $res=mysqli_query($conn,$sql);
                            //count the rows to check whether we havecategories or not
                            $count=mysqli_num_rows($res);

                            //if count is greater than 0,we have categories else we don't have categories
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $category_id=$row['category_id'];
                                    $title=$row['title'];
                                    ?>
                                    
                                    <option value="<?php echo $category_id; ?>"><?php echo $title;?></option>

                                    <?php
                                }
                            }
                            else{
                                //we don't  have category

                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            //2.display on Description
                        ?>
                            
                    </select>
                    </td>

                </tr>
                
                <tr>
                    <td>Ingredients:</td>
                    <td>
                        <textarea name="ingredients" cols="40" rows="15" placeholder="Ingredients of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Procedure:</td>
                    <td>
                        <textarea name="proce" cols="40" rows="55" placeholder="Procedure "></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Time:</td>
                    <td>
                        <input type="number" name="time" >
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                    <input type="file" name="image">
                    </td>

                </tr>
                
                
                <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>

                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>

                </tr>
                <tr>
                    <td>
                        Verified:
                    </td>
                    <td>
                        <input type="radio" name="verified" value="Yes">Yes
                        <input type="radio" name="verified" value="No">No
                    </td>

                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

                //check whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Add the food in database
                    
                        //1.get the data from form
                        //$title=$_POST['title'];
                        $food= mysqli_real_escape_string($conn,$_POST['food']);

                        //$description=$_POST['description'];
                        $ingredients=$_POST['ingredients'];
                        $proce=$_POST['proce'];

                        $time=$_POST['time'];
                        $category=$_POST['category'];

                        //check whether radio button for featured and active are checked or not
                        if(isset($_POST['featured']))
                        {
                            $featured=$_POST['featured'];
                        }
                        else
                        {
                            $featured="No"; //Setting the default value
                        }
                        if(isset($_POST['active']))
                        {
                            $active=$_POST['active'];
                        }
                        else
                        {
                            $active="No"; //Setting the default value
                        }
                        if(isset($_POST['featured']))
                        {
                            $featured=$_POST['featured'];
                        }
                        else
                        {
                            $featured="No"; //Setting the default value
                        }
                    //2.upload the image if selected
                        //check whether the select image is clicked or not and upload the image accordingly if the image is selected
                        if(isset($_FILES['image']['name']))
                        {
                            //get the details of the selected image
                            $image_name=$_FILES['image']['name'];
                            //check whether the image is selected or not and upload it only if selected
                            if($image_name != "")
                            {
                                    //image is selected
                                    //A. Rename the image
                                    //get the extension of selected image

                                    
                                
                                $ex=explode('.',$image_name);
                                $ext=end($ex);
                                //Rename the image
                                $image_name="Food_Name_".rand(000,999).'.'.$ext; 

                                //B.upload the image
                                    //get the src path and destination pathe

                                    //source path is current location of the image
                                    $src=$_FILES['image']['tmp_name'];
                                    //destination path for the image to be uploaded
                                    $dst="../images/food/".$image_name;

                                    //upload the food image
                                    $upload=move_uploaded_file($src,$dst);


                                //check whether image uploaded or not
                                    if($upload==false)
                                    {
                                        //failed to upload the image
                                        //redirect to the add food page with error message
                                        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                                        header('location:'.SITEURL.'admin/add-food.php');
                                        //stop the process
                                        die();
                                    } 
                                } 
                            }
                            else{
                                $image_name="";//setting default value as blank
                            }
                        //3.insert into database
                            //create  a sql query to save or add data
                            $sql2="INSERT INTO tbl_food set
                                    food='$food',
                                    ingredients='$ingredients',
                                    proce='$proce',
                                    time='$time',
                                    image_name='$image_name',
                                    category_id=$category,
                                    user_id='$user_id',
                                    featured='$featured',
                                    active='$active'
                                    verified='$verified'
                                    ";
                            //execute the query
                            $res2=mysqli_query($conn,$sql2);
                            //check whether data inserted or not
                            //4.redirect with message to manage food page
                            if($res2==true)
                            {
                                //data inserted successfully
                                $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                                header("location:".SITEURL.'admin/manage-food.php');
                            }
                            else
                            {
                                //failed to insert data
                                $_SESSION['add']="<div class='error'>Failed to Add Food.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                
                            }
                        
                }

        ?>

    </div>
</div>


<?php
    include('partials/footer.php');
    ob_end_flush();
?>