<?php include('partials/menu.php');?>


        <div class="main-content">
            <div class="wrapper">
                <h1>Manage User</h1>
<br /><br>

<?php 
     if(isset($_SESSION['add']))
     {
         echo $_SESSION['add'];
         unset($_SESSION['add']);

     }

    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found'])){
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);
    }
    if(isset($_SESSION['pwd-not-found'])){
        echo $_SESSION['pwd-not-found'];
        unset($_SESSION['pwd-not-found']);
    }
    if(isset($_SESSION['change-pwd'])){
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
    }



    ?>
    <br> <br><br>














    <!--new-->
    <a href="add-user.php" class="btn-primary">Add User</a>
    <br />
                <br>
                <br>
                <br>

    <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Username
                        </th>
                        
                        <th>
                            Actions
                        </th>
                    </tr>

                    <?php
                    
                    //get all the user data from database
                    $sql="select * from tbl_user order by user_id desc";
                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    //count the rows
                    $count=mysqli_num_rows($res);
                    $sn=1;

                    if($count>0)
                    {
                        //user available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $user_id=$row['user_id'];
                            $user_name=$row['user_name'];
                            $user_userid=$row['user_userid'];
                            $user_pass=$row['user_pass'];
                            

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $user_userid; ?></td>
                                
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/user-data.php?user_id=<?php echo $user_id; ?>" ><img src="../images/rec/search.png" alt="Update User"  style="width:27px;height:27px;"></a>

                                    <a href="<?php echo SITEURL; ?>admin/update-userpassword.php?user_id=<?php echo $user_id; ?>"  ><img src="../images/rec/password.png" alt="Change Password"  style="width:36px;height:36px;"></a>

                                    <a href="<?php echo SITEURL; ?>admin/update-user.php?user_id=<?php echo $user_id; ?>" ><img src="../images/rec/edit.png" alt="Update User"  style="width:27px;height:27px;"></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-user.php?user_id=<?php echo $user_id; ?>"><img src="../images/rec/delete.png" alt="Delete User" style="width:31px;height:31px;"></a>
                                </td>
                                

                            </tr>
                   


                            <?php


                            

                        }
                    }
                    else
                    {
                        //user not found
                        echo "<tr><td colspan='12' class='error' style='text-align:center'>User Not Found</td></tr>"; 
                    }
                    
                            ?>


                    



    </table>
</div>
</div>





<?php include('partials/footer.php');?>