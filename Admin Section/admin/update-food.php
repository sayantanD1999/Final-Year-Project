<?php
    include('partials/menu.php');
    ob_start();

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br>
        <br>
        <?php
        
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and all other details
                $id=$_GET['id'];

                //create SQL query to get selected details
                $sql2="select * from tbl_food where id=$id";
                

                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //get the value based on query executed
                $row2=mysqli_fetch_assoc($res2);

                //get the individual values of selected food
                $food=$row2['food'];
                $proce=$row2['proce'];

                $ingredients=$row2['ingredients'];
                $time=$row2['time'];
                $current_image=$row2['image_name'];
                $current_category=$row2['category_id'];
                $type=$row2['type'];
                
                $status=$row2['status'];
                $serving=$row2['serving'];




                
                
            }
            else
            {
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Food:</td>
                <td><?php echo $food;?>
                
                   <!-- <input type="text" name="food" value="">-->
                </td>
            </tr>
            <tr>
                <td>Preperation Time:</td>
                    <td><?php echo $time;?>
                    <!--<input type="number" name="time" value="">-->
                    </td>
            </tr>
            <tr>
                <td>Ingredients:</td>
                    <td><?php echo $ingredients; ?>
                       <!-- <textarea name="ingredients" cols="40" rows="15" ></textarea>-->
                    </td>
            </tr>
            <tr>
                <td>Procedure:</td>
                    <td><?php echo $proce; ?>
                       <!-- <textarea name="proce" cols="40" rows="25" ></textarea>-->
                    </td>
            </tr>
            <tr>
                <td>Serving:</td>
                    <td><?php echo $serving;?>
                    <!--    <input type="number" name="serving" value="">-->
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image=="")
                        {
                            //image not available
                            echo "<div class='error'>Image Not Available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px">
                            <?php
                        }
                        ?>
                    
                </td>

            </tr>
           <!-- <tr>
                <td>Select New Image:</td>
                <td>
                <input type="file" name="image">
                </td>

            </tr>-->
            <tr>
                <td>Category:</td>
               <!-- <select name="category">-->
               <?php

//query to get active categories


$sql="select * from tbl_category where category_id=$current_category";
//execute the query

$res=mysqli_query($conn,$sql);
//count rows

$count=mysqli_num_rows($res);

//check whether category available or not
if($count>0)
{
    //category available
    while($row=mysqli_fetch_assoc($res))
    {
        $category_title=$row['title'];
        $category_id=$row['category_id'];

?>
        <td><?php echo $category_title ?></td>

<?php
    }
}
else
{
    //category not available
    ?>
    <td><?php echo "Category not available" ?></td>
    <?php

}
        
?>




</td>



                
                
                
                
                       

                              
                            
                    

                </tr>
                <tr>
                    <td>
                        Type(Traditional/Commercial):
                    </td>
                    <td>
                    <input <?php if($type=="Commercial"){echo "checked";}?> type="radio" name="type" value="Commercial">Commercial
                    <input <?php if($type=="Traditional"){echo "checked";}?> type="radio" name="type" value="Traditional">Traditional               
                    <input <?php if($type=="Both"){echo "checked";}?> type="radio" name="type" value="Both">Both             

                    </td>

                </tr>

                <tr>
                    <td>
                        Status:
                    </td>
                    <td>
                    <input <?php if($status=="Checked"){echo "checked";}?> type="radio" name="status" value="Checked">Checked
                    <input <?php if($status=="Not Checked"){echo "checked";}?> type="radio" name="status" value="Not Checked">Not Checked                
     
                    </td>

                </tr>
              <!--  <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No                
     
                    </td>

                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>

                </tr>
               <tr>
                    <td>
                        Verified:
                    </td>
                    <td>
                    <input <?php if($verified=="Yes"){echo "checked";}?> type="radio" name="verified" value="Yes">Yes
                    <input <?php if($verified=="No"){echo "checked";}?> type="radio" name="verified" value="No">No
                    </td>

                </tr>-->
                
                
                <tr>
                    <td>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    
                    <!--<input type="hidden" name="current_image" value=""-->
                    
                    <input type="submit" name="submit" value="Update Food Recipe" class="btn-secondary">

<?php
?>                </td>
                </tr>
 
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // 1. get all the value from our form
               $id=$_POST['id'];
                //$food=mysqli_real_escape_string($conn,$_POST['food']);
               // $ingredients=$_POST['ingredients'];
                //$proce=$_POST['proce'];

                //$time=$_POST['time'];
                //$current_image=$_POST['current_image'];
                //$category_id=$_POST['category'];
                $status=$_POST['status'];
               // $serving=$_POST['serving'];

                $type=$_POST['type'];

                //2. Upload the image if selected
                //check whether the image is selected or not
               /* if(isset($_FILES['image']['name']))
                {
                    //upload button clicked
                    $image_name=$_FILES['image']['name']; //new image name
                    //check whether image is available or not
                    if($image_name!="")
                    {
                        //image available
                        
                            //Auto rename our image
                            //Get the extension of our image
                            $ex=explode('.',$image_name);
                            $ext=end($ex);
                            //Rename the image
                            $image_name="Food-Name-".rand(0000,9999).'.'.$ext;   

                    

                            $source_path=$_FILES['image']['tmp_name'];
                            $destination_path="../images/food/".$image_name;

                            //Finally upload the image
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //check whether the image is uploaded or not

                            //And if the image is not uploaded then we will stop the process and redirect with error message

                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload New Image. </div>";
                                //redirect to manage food page
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }

                        //3.remove the image if new image uploaded and current image exists
                        //Remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path="../images/food/".$current_image;

                                $remove=unlink($remove_path);

                            //check whether the image is removed or not
                            //if failed to remove then display message and stop the process
                                if($remove == false)
                                {
                                //failed to remove the image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-food.php');
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
                }*/
                

                //3. update the food database
                $sql3="UPDATE tbl_food set
                        
                        
                        status='$status',
                        type='$type'
                        
                        WHERE id=$id";
                        
                //execute the query
                $res3=mysqli_query($conn,$sql3);

                //4. Redirect to manage Food with message
                //check whether the query is executed or not
                if($res3==true)
                {
                    //food updated
                    $_SESSION['update']="<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //failed to update food
                    
                    $_SESSION['update']="<div class='error'>Failed to Update Food.</div>$status$id$active$featured$verified";
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

