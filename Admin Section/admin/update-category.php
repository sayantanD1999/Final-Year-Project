<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br>
        <br>
        <?php
        
            //check whether the id is set or not
            if(isset($_GET['category_id']))
            {
                //get the id and all other details
                $category_id=$_GET['category_id'];

                //create SQL query to get other details
                $sql="select * from tbl_category where category_id=$category_id";

                //execute the query
                $res=mysqli_query($conn,$sql);

                //count the rows to check whether the value is valid or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                   // $featured=$row['featured'];
                   // $active=$row['active'];
                }
                else{
                    //redirect to manage category with session message

                    $_SESSION['no-category-found']="<div class='error'>Category Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td>
                   <?php

                        if($current_image!="")
                        {
                            //Display the image
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150 px">
                            <?php
                        }
                        else
                        {
                            //display message
                            echo "<div class='error'>Image Not Added.</div>";

                        }
                   ?>
                </td>
            </tr>

            <tr>
                <td>
                    New Image:
                </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

          <!--  <tr>
                <td>
                    Featured:
                </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No                </td>
            </tr>

            <tr>
                <td>
                    Active:
                </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>-->

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // 1. get all the value from our form
                $category_id=$_POST['category_id'];
                $title=mysqli_real_escape_string($conn,$_POST['title']);
                $current_image=$_POST['current_image'];
               // $featured=$_POST['featured'];
                //$active=$_POST['active'];

                //2. Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name=$_FILES['image']['name'];
                    //check whether image is available or not
                    if($image_name!="")
                    {
                        //image available
                        //A.upload the new image
                            //Auto rename our image
                            //Get the extension of our image(jpg,png etc.)
                            $ext=end(explode('.',$image_name));

                            //Rename the image
                            $image_name="Food_Category_".rand(000,999).'.'.$ext;   //e.g. Food_Category_834.jpg

                    

                            $source_path=$_FILES['image']['tmp_name'];
                            $destination_path="../images/category/".$image_name;

                            //Finally upload the image
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //check whether the image is uploaded or not

                            //And if the image is not uploaded then we will stop the process and redirect with error message

                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload Image. </div>";
                                //redirect to manage category page
                                header('location'.SITEURL.'admin/manage-category.php');
                                //stop the process
                                die();
                            }

                        
                        //B.Remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path="../images/category/".$current_image;

                                $remove=unlink($remove_path);

                            //check whether the image is removed or not
                            //if failed to remove then display message and stop the process
                                if($remove == false)
                                {
                                //failed to remove the image
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();  //stop the process
                                }
                            }
                            
                    }
                    else
                    {
                        $image_name=$current_image;   
                    }
                }
                else
                {
                    $image_name=$current_image;
                }

                //3. update the database// deleted active,featured
                $sql2="update tbl_category set
                        title='$title',
                        image_name='$image_name'
                        
                        where category_id=$category_id";
                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //4. Redirect to manage category with message
                //check whether executed or not
                if($res==true)
                {
                    //category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully$image_name.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update']="<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
            }
        ?>

    </div>
</div>


<?php
    include('partials/footer.php');
?>
