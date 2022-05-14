<?php 
        include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>
            Update User
        </h1>

        <br>
        <br>

     <?php 
        
        //1.get the id of selected admin
      $user_id=$_GET['user_id'];
        

        //2.create sql query to get the details
        $sql="select * from tbl_user where user_id=$user_id";

        //3.execute the query
        $res=mysqli_query($conn, $sql);

        //4.check whether the query is executed or not
        if($res==TRUE){

            //check whether data is available or not
            $count=mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1){

                //get the details
                $row=mysqli_fetch_assoc($res);
                $user_name=$row['user_name'];
                $user_userid=$row['user_userid'];
                

            }
            else{
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-user.php');
            }

        }
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Full Name:
                    </td>
                    <td><input type="text" name="user_name" value="<?php echo $user_name; ?>"></td>
                </tr>

                <tr>
                    <td>
                        Username:
                    </td>
                    <td><input type="email" name="user_userid" value="<?php echo $user_userid; ?>"></td>
                </tr>
                
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="submit" name="submit" value="Update User" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        

</div>
</div>
        
<?php

    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
       //get all the values from form to update
       $user_id =$_POST['user_id'];
       $user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
       $user_userid=mysqli_real_escape_string($conn,$_POST['user_userid']);

       //create a sql query to update admin
       $sql="update tbl_user set
       user_name='$user_name',
       user_userid='$user_userid'
       where user_id='$user_id'
       ";

       //execute the query
       $res=mysqli_query($conn,$sql);

       //check whether the query executed successfully or not
       if($res==true){
           //query executed and admin updated
           $_SESSION['update']="<div class='success'>User updated successfully</div>";
           //redirect to manage admin page
           header('location:'.SITEURL.'admin/manage-user.php');

       }
       else{
           //failed to update user
           $_SESSION['update']="<div class='error'>Failed to Update User </div>";
           //redirect to manage user page
           header('location:'.SITEURL.'admin/manage-user.php');
       }
    }
?>



<?php 
        include('partials/footer.php');
?>