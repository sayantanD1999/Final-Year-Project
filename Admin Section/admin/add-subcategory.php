<?php

    include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add SubCategory</h1>

        <br><br>
        
        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['upload'])) //checking whether the session is set or not
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
            <br><br>




            
       <!-- if(isset($_GET['category_id']))
            {
                //get the id and all other details
                $category_id=$_GET['category_id'];

                //create SQL query to get selected details
                $sql2="select * from tbl_food where category_id=$category_id";

                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //get the value based on query executed
                $row2=mysqli_fetch_assoc($res2);

                //get the individual values of selected food
                $title=$row2['title'];
                
                $current_image=$row2['image_name'];
                $current_category=$row2['category_id'];
                

                
                
            }
            else
            {
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-subcategory.php');
            }-->
        
        
<?php        
 $category_id=$_GET['category_id'];

echo $category_id;?>

        <!-- add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td><input type="text" name="stitle" placeholder="SubCategory Title"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

               <!-- <tr>
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

                </tr>-->
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add SubCategory" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category form ends -->

        <?php

            if(isset($_POST['submit'])){

                //1.get the value from category form
               // $title=$_POST['title'];
                $stitle= mysqli_real_escape_string($conn,$_POST['stitle']);

                //2.for radio input, we need to check whether the button is selected or not
              /*  if(isset($_POST['featured'])){
                    //get the value from form
                    $featured=$_POST['featured'];

                }
                else{
                    //set the default value 
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    //get the value from form
                    $active=$_POST['active'];

                }
                else{
                    //set the default value 
                    $active="No";
                }*/

                //check whether the image is selected or not and set the value for image accordingly
               // print_r($_FILES['image']);

               // die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //To upload image we need image name,source path and destination path
                    $simage_name=$_FILES['image']['name'];

                    //upload the image only if imageis selected
                    if($simage_name !="")
                    {

                    
                    
                        //Auto rename our image
                        //Get the extension of our image(jpg,png etc.)
                        $ext=end(explode('.',$simage_name));

                        //Rename the image
                        $simage_name="Food_SubCategory_".rand(000,999).'.'.$ext;   //e.g. Food_Category_834.jpg

                    

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$simage_name;

                        //Finaly upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not

                        //And if the image is not uploaded then we will stop the process and redirect with error message

                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload Image. </div>";
                            //redirect to add category page
                            header('location'.SITEURL.'admin/add-subcategory.php');
                            //stop the process
                            die();
                        }

                    }
                }
                else{
                    //Don't upload the image and set the image_name value as null
                    $simage_name="";
                }

                //2. create sql query to insert category into database
                $sql="insert into tbl_subcategory set
                    stitle='$stitle',
                    simage_name='$simage_name'
                    
                    ";

                //3.execute the query and save in database
                $res=mysqli_query($conn,$sql);

                //4.check whether the query executed or not and data added or not
                if($res==TRUE){
                    //create a session variable to display message
                    $_SESSION['add']="<div class='success'>SubCategory Added Successfully$stitle$simage_name$category_id</div>";
                
                    //redirect page to manage admin
                    header("location:".SITEURL.'admin/manage-subcategory.php');
                }
                else{
                
                    //create a session variable to display message
                    $_SESSION['add']="<div class='error'>Failed to Add SubCategory$category_id</div> ";
                
                    //redirect page to add admin
                    header("location:".SITEURL.'admin/add-subcategory.php');
                }
            }

        ?>
    </div>
</div>



<?php

    include('partials/footer.php');

?>