<?php 
    //include constants file
    include('../config/constants.php');
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //1.get id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        //2.remove the image if available
        if($image_name!="")
        {
            //image is available.so remove it.
            //get the image path
            $path="../images/food/".$image_name;
            //remove the image from folder
            $remove=unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message 
                $_SESSION['upload']="<div class='error'>Failed to Remove Image File</div>";
                //redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process
                die();

            }
        }

        //3.delete data from database
        //sql query to delete data from database
        $sql="delete from tbl_food where id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the data is deleted from database or not
        //4.redirect to manage-food page with session message
        if($res==true){

            //set success message and redirect
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";

            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";

            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //redirect to manage food page
        $_SESSION['unauthorize']="<div class=error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }
?>