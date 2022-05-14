<?php include('partials/menu.php');?>
<div class="main-content">
   <div class="wrapper"> <h1>Manage Food</h1> 
   <br /><br>
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

<br />
                <br>
                <br>
                <br>

                <?php

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);

                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);

                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);

                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);

                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);

                    }

                ?>
                
                <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Preparation Time
                        </th>
                        <th>
                            Serving
                        </th>
                        
                        
                        <th>
                            Images
                        </th>
                        <th>
                            Author
                        </th>

                        <th>
                            Featured
                        </th>
                        <th>
                            Active
                        </th>
                        <th>
                            Verified
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>


                    <?php
                            //query to get all the food 
                            $sql="select * from tbl_food";

                            //execute query
                            $res=mysqli_query($conn,$sql);

                            //count rows
                            $count=mysqli_num_rows($res);

                            //create a serial number variable and assign value as 1
                            $sn=1;

                            //check whether we have data in database or not
                            if($count>0)
                            {
                                //we have food in database
                                //get the food from database and display
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the values from individual columns
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $time=$row['time'];
                                    $serving=$row['serving'];
                                    
                                    $image_name=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];
                                    $verified=$row['verified'];
                                    $author=$row['author'];
                                    
                        ?>
                                        <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $title;?></td>
                                            <td><?php echo $time;?></td>
                                            <td><?php echo $serving;?></td>
                                            <td>
                                                <?php 
                                                //check whether the image name is available or not
                                                    if($image_name=="")
                                                    {
                                                        //we do not have image,display the error message
                                                        echo "<div class='error'>Image not Added.</div>";
                                                        
                                                    }
                                                    else
                                                    {
                                                        //display the image
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>"width="100px"> 
                                                        <?php
                                                    }
                                            
                                                    ?>
                                            </td>
                                            <td><?php echo $author;?></td>
                                            <td><?php echo $featured;?></td>
                                            <td><?php echo $active;?></td>
                                            <td><?php echo $verified;?></td>
                                            <td><a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger" >Delete Food</a>
                                            </td>

                                        </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //food not added in database
                                //we will display the message inside the table
                                echo "<tr><td colspan='7'><div class='error'>Food Not Added Yet.</div></td></tr>";
                                
                            }

                    ?>
                       
                    

                </table>
</div>
</div>
<?php include('partials/footer.php');?>
