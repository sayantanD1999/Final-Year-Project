<?php include('partials/menu.php');?>
<div class="main-content">
   <div class="wrapper"> <h1>Manage Category</h1> 


   <br /><br> <br />

   <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])) 
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])) 
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            ?>
            <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

               
                <br>
                <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Image
                        </th>
                      <!--  <th>
                            Featured
                        </th>
                        <th>
                            Active
                        </th>-->
                        <th>
                            Actions
                        </th>
                    </tr>

                    <?php
                            //query to get all categories from database
                            $sql="select * from tbl_category";

                            //execute query
                            $res=mysqli_query($conn,$sql);

                            //count rows
                            $count=mysqli_num_rows($res);

                            //create a serial number variable and assign value as 1
                            $sn=1;

                            //check whether we have data in database or not
                            if($count>0)
                            {
                                //we have data in database
                                //get the data and display
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_id=$row['category_id'];
                                    $title=$row['title'];
                                    $image_name=$row['image_name'];
                                    //$featured=$row['featured'];
                                   // $active=$row['active'];
                                    
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $title;?></td>
                                            <td>
                                                <?php 
                                                //check whether the image name is available or not
                                                    if($image_name!="")
                                                    {
                                                        //display the image
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>"width="100px"> 
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        //display the message
                                                        echo "<div class='error'>Image not Added.</div>";
                                                    }
                                            
                                                    ?>
                                            </td>
                                            <!--<td><?php echo $featured;?></td>
                                            <td><?php echo $active;?></td>-->
                                            <td>
                                            <a href="<?php echo SITEURL; ?>admin/manage-subcategory.php?category_id=<?php echo $category_id;?>" ><img src="../images/rec/search.png" alt="Update"  style="width:18px;height:18px;"></a>

                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?category_id=<?php echo $category_id;?>" ><img src="../images/rec/edit.png" alt="Update"  style="width:18px;height:18px;"></a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?category_id=<?php echo $category_id;?>&image_name=<?php echo $image_name;?>"  ><img src="../images/rec/delete.png" style="width:23px;height:23px;"></a>
                                            </td>

                                        </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have data 
                                //we will display the message inside the table
                                ?>
                                    <tr>
                                        <td colspan="6"><div class="error">No Category Added.</div></td>
                                    </tr>
                                <?php
                            }

                    ?>



                    
                    

                </table>
                </div>
</div>
<?php include('partials/footer.php');?>
