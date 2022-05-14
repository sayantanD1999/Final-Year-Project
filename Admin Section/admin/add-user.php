<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            Add User
        </h1>
        <br>
        <br>

        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
<?php  $category_id=$_GET['category_id'];?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Full Name:
                    </td>
                    <td><input type="text" name="user_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>
                        Username / Email:
                    </td>
                    <td><input type="email" name="user_userid" placeholder="Enter Your Email Address"></td>
                </tr>
                <tr>
                    <td>
                        Password:
                    </td>
                    <td><input type="password" name="user_pass" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add User" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 

//process the value from form and save it  in database
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){

    //1.get the data from form
    //$full_name=$_POST['full_name'];
    $user_name= mysqli_real_escape_string($conn,$_POST['user_name']);

    //$username=$_POST['username'];
    $user_userid= mysqli_real_escape_string($conn,$_POST['user_userid']);

    $user_pass=md5($_POST['user_pass']);//password encryption with md5 which is a one way encryption function,we can not decrypt the password
//2.sql query to save data into database
$sql="insert into tbl_user set
user_name='$user_name',
user_userid='$user_userid',
user_pass='$user_pass'
";

//3.executing query and saving data into database
$res=mysqli_query($conn,$sql ) or die(mysqli_error());

//4.check whether the (query is executed) data is inserted or not and display appropriate message
if($res==TRUE){
    //create a session variable to display message
    $_SESSION['add']="<div class='success'>User Added Successfully</div>";

    //redirect page to manage admin
    header("location:".SITEURL.'admin/manage-user.php');
}
else{

    //create a session variable to display message
    $_SESSION['add']="<div class='error'>Failed to Add User</div> ";

    //redirect page to add admin
    header("location:".SITEURL.'admin/add-user.php');
}

}
?>