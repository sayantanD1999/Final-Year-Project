<?php 

    //include constants.php file here
    include('../config/constants.php');

    //1.get the  id of admin to be deleted
    $user_id=$_GET['user_id'];

    //2.create sql query to delete admin
    $sql="delete from tbl_user where user_id=$user_id";
//DELETE FROM `tbl_user` WHERE `tbl_user`.`user_id` = 2"
    //execute the query
    $res=mysqli_query($conn,$sql);
    echo $res;
    echo $sql;
    
    //check whether the query is executed or not
    if($res==TRUE){
        //query executed successfully and admin deleted
        //CREATE SESSION VARIABLE TO DISPLAY MESSAGE
        $_SESSION['delete']="<div class='success'>User deleted successfully</div>";

        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-user.php');
    }
    else{
        //failed to delete admin
        $_SESSION['delete']="</div class='error'>Failed to Delete User. Try Again Later</div>";

        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-user.php');
    }

    //3.redirect to manage admin page with message(success/error)

?>