<?php 
    //include constants file
    include('../config/constants.php');
    //check whether the id and image_name value is set or not
    if(isset($_GET['subcategory_id']) AND isset($_GET['simage_name']))
    {
        $subcategory_id=$_GET['subcategory_id'];
        $simage_name=$_GET['simage_name'];
        //remove the physical image file if available
        if($simage_name!="")
        {
            //image is available.so remove it.
            $path="../images/category/".$simage_name;
            //remove the image
            $remove=unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message 
                $_SESSION['remove']="<div class='error'>Failed to Remove SubCategory Image </div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-subcategory.php');
                //stop the process
                die();

            }
        }

        //delete data from database
        //sql query to delete data from database
        $sql="delete from tbl_subcategory where subcategory_id=$subcategory_id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the data is deleted from database or not
        if($res==true){

            //set success message and redirect
            $_SESSION['delete']="<div class='success'>Subcategory Deleted Successfully.</div>";

            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-subcategory.php');
        }
        else{
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete SubCategory.</div>";

            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-subcategory.php');
        }

        //redirect to manage category page with message

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-subcategory.php');

    }
?>