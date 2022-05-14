<?php

    include('partials/menu.php');

?>
<div class="main-content">
    <div class="wrapper">
        <h1>
            Change Password
        </h1>

        <br>
        <br>

        <?php 
        
        if(isset($_GET['user_id'])){
            $user_id=$_GET['user_id'];
        }
                
        ?>

        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Current Password
                    </td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>
                    New Password
                    </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password
                    </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
    </div>
</div>

<?php

    //1.check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
       //get all the data from form 
       $user_id =$_POST['user_id'];
       $current_password=md5($_POST['current_password']);
       $new_password=md5($_POST['new_password']);
       $confirm_password=md5($_POST['confirm_password']);


       //2.check whether the user with current id and current pasword exists or not
       $sql="select * from tbl_user where user_id=$user_id and user_pass='$current_password'";

       //execute the query
       $res=mysqli_query($conn,$sql);

       if($res==true)
       {

        //check whether data is available or not
        $count=mysqli_num_rows($res);

        if($count==1){
            //user exist and password can be changed
            //check whether the new password and confirm password match or not
            if($new_password==$confirm_password){
                //update the password
                $sql2="update tbl_user
                    set user_pass='$new_password'
                    where user_id=$user_id";
                //execute the query
                $res2=mysqli_query($conn, $sql2);

                //check whether the query executed or not
                if($res2==true){

                    //display message
                    $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully </div>";
                    header('location:'.SITEURL.'admin/manage-user.php');
                }
                else{
                    //display error message
                    $_SESSION['change-pwd']="<div class='error'>Failed to Change Password </div>";
                    header('location:'.SITEURL.'admin/manage-user.php');
                }
            }
            else{
                //redirect to the admin page with error message
                $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Match </div>";
                header('location:'.SITEURL.'admin/manage-user.php');


            }

        }


          

      
       else{
           //user does not exist set message and redirect
           $_SESSION['user-not-found']="<div class='error'>User Not Found </div>";
           header('location:'.SITEURL.'admin/manage-user.php');

       }
    
    }
}
?>
  <?php include('partials/footer.php');?>