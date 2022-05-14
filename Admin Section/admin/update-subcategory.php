<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Subcategory</h1>

        <br>
        <br>
        <?php
        
            //check whether the id is set or not
            if(isset($_GET['subcategory_id']))
            {
                //get the id and all other details
                $subcategory_id=$_GET['subcategory_id'];

                //create SQL query to get other details
                $sql="select * from tbl_subcategory where subcategory_id=$subcategory_id";

                //execute the query
                $res=mysqli_query($conn,$sql);

                //count the rows to check whether the value is valid or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row=mysqli_fetch_assoc($res);
                    $stitle=$row['stitle'];
                    $scurrent_image=$row['simage_name'];
                   // $featured=$row['featured'];
                   // $active=$row['active'];
                }
                else{
                    //redirect to manage category with session message

                    $_SESSION['no-category-found']="<div class='error'>Subcategory Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-subcategory.php');
                }
            }
            else
            {
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-subcategory.php');
            }
        
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="stitle" value="<?php echo $stitle; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td>
                   <?php

                        if($scurrent_image!="")
                        {
                            //Display the image
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $scurrent_image;?>" width="150 px">
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
                    <input type="hidden" name="scurrent_image" value="<?php echo $scurrent_image;?>">
                    <input type="hidden" name="subcategory_id" value="<?php echo $subcategory_id;?>">
                    <input type="submit" name="submit" value="Update Subcategory" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // 1. get all the value from our form
                $subcategory_id=$_POST['subcategory_id'];
                $stitle=mysqli_real_escape_string($conn,$_POST['stitle']);
                $scurrent_image=$_POST['scurrent_image'];
               // $featured=$_POST['featured'];
                //$active=$_POST['active'];

                //2. Updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $simage_name=$_FILES['image']['name'];
                    //check whether image is available or not
                    if($simage_name!="")
                    {
                        //image available
                        //A.upload the new image
                            //Auto rename our image
                            //Get the extension of our image(jpg,png etc.)
                            $ext=end(explode('.',$simage_name));

                            //Rename the image
                            //$simage_name="Food_SubCategory_".rand(000,999).'.'.'png';   //e.g. Food_Category_834.jpg

                            $simage_name="Food_SubCategory_".rand(000,999).'.'.$ext;   //e.g. Food_Category_834.jpg

                    

                            $source_path=$_FILES['image']['tmp_name'];
                            $destination_path="../images/category/".$simage_name;

                            //Finally upload the image
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //check whether the image is uploaded or not

                            //And if the image is not uploaded then we will stop the process and redirect with error message

                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload Image. </div>";
                                //redirect to manage category page
                                header('location'.SITEURL.'admin/manage-subcategory.php');
                                //stop the process
                                die();
                            }

                        
                        //B.Remove the current image if available
                            if($scurrent_image!="")
                            {
                                $remove_path="../images/category/".$scurrent_image;

                                $remove=unlink($remove_path);

                            //check whether the image is removed or not
                            //if failed to remove then display message and stop the process
                                if($remove == false)
                                {
                                //failed to remove the image
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-subcategory.php');
                                    die();  //stop the process
                                }
                            }
                            
                    }
                    else
                    {
                        $simage_name=$scurrent_image;   
                    }
                }
                else
                {
                    $simage_name=$scurrent_image;
                }

                //3. update the database// deleted active,featured
                $sql2="update tbl_subcategory set
                        stitle='$stitle',
                        simage_name='$simage_name'
                        
                        where subcategory_id=$subcategory_id";
                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //4. Redirect to manage category with message
                //check whether executed or not
                if($res==true)
                {
                    //category updated
                    $_SESSION['update']="<div class='success'>Subcategory Updated Successfully $simage_name .</div>";
                    header('location:'.SITEURL.'admin/manage-subcategory.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update']="<div class='error'>Failed to Update Subcategory.</div>";
                    header('location:'.SITEURL.'admin/manage-subcategory.php');

                }
            }
        ?>

    </div>
</div>


<?php
    include('partials/footer.php');
?>
