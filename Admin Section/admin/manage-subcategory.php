<?php include('partials/menu.php');?>
<div class="main-content">
   <div class="wrapper"> <h1>Manage Subcategory</h1> 


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
          <?php  $category_id=$_GET['category_id'];

?>

        <a href="<?php echo SITEURL; ?>admin/add-subcategory.php?category_id=<?php echo $category_id;?>" class="btn-primary">Add Subcategory</a>

               
                <br>
                <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Subcategory
                        </th>
                       <!-- <th>
                            Category
                        </th>-->
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
                    
                    $category_id=$_GET['category_id'];
                   echo $category_id;

                    //$category_id=$_GET['category_id'];
                            //query to get all categories from database
                            $sql="select * from tbl_subcategory  ";

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
                                    $subcategory_id=$row['subcategory_id'];
                                   // $category_id=$row['category_id'];
                                   $sql2="select title from tbl_category where category_id='$category_id'";
                            $res2=mysqli_query($conn,$sql2);
                            $count2=mysqli_num_rows($res2);
                    

                    if($count2>0)
                    {
                        while($row2=mysqli_fetch_assoc($res2))
                        {
                        $title=$row2['title'];
                        }
                    }

                                    $stitle=$row['stitle'];
                                    $simage_name=$row['simage_name'];
                                    //$featured=$row['featured'];
                                   // $active=$row['active'];
                                    
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $stitle;?></td>
                                           <!-- <td><?php echo $title;?></td>-->

                                            <td>
                                                <?php 
                                                //check whether the image name is available or not
                                                    if($simage_name!="")
                                                    {
                                                        //display the image
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $simage_name; ?>"width="100px"> 
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        //display the message
                                                        echo "<div class='error'>Image not Added.</div>";
                                                    }
                                            
                                                    ?>
                                            </td>
                                            
                                            
                                            <td>
                                            <a href="<?php echo SITEURL; ?>admin/subcategory-data.php?subcategory_id=<?php echo $subcategory_id; ?>&category_id=<?php echo $category_id;?>" ><img src="../images/rec/search.png" alt="Subcategory"  style="width:27px;height:27px;"></a>
    
                                            <a href="<?php echo SITEURL; ?>admin/update-subcategory.php?subcategory_id=<?php echo $subcategory_id;?>" ><img src="../images/rec/edit.png" alt="Update"  style="width:28px;height:28px;"></a>
    
                                            <a href="<?php echo SITEURL; ?>admin/delete-subcategory.php?subcategory_id=<?php echo $subcategory_id;?>&simage_name=<?php echo $simage_name;?>"  ><img src="../images/rec/delete.png" style="width:33px;height:33px;"></a>
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
                                        <td colspan="6"><div class="error">No Subcategory Added.</div></td>
                                    </tr>
                                <?php
                            }

                    ?>



                    
                    

                </table>
                </div>
</div>
<?php include('partials/footer.php');?>
