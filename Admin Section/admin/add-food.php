<?php include('partials/menu.php');?>
<div class="main-content">
   <div class="wrapper"> <h1>Add Food Recipe</h1> 
        <br>
                <br>
                <br>
                
                    <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Food
                        </th>
                        
                        <th>
                            Preparation Time
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
                    
                    //get all the data from database
                    $sql="select * from tbl_food order by id desc";
                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    //count the rows
                    $count=mysqli_num_rows($res);
                    $sn=1;

                    if($count>0)
                    {
                        //Order available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $food=$row['food'];
                            $time=$row['time'];
                            $ingredients=$row['ingredients'];
                            $proce=$row['proce'];
                            $category_id=$row['category_id'];
                            
                            $verified=$row['verified'];
                            $user_name=$row['user_name'];
                            $image_name=$row['image_name'];
                            $status=$row['status'];
                            $active=$row['active'];
                            $featured=$row['featured'];



                            

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $time; ?></td>
                                
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
                                <td><?php echo $user_name; ?></td>

                                



                                
                    


                    <td><?php 
                                
                                    //checked or not
                                    if($status=="Checked")
                                    {
                                        echo "<label style='color:green;'>$status</label>";
                                    }
                                    
                                    elseif($status=="Not Checked")
                                    {
                                        echo "<label style='color:red;'>$status</label>";
                                    }

                                
                                ?></td>

                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td><?php echo $verifieded;?></td>
                                <td><a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger" >Delete Food</a>
                                </td>

                                

                                
                                
                                
                                

                            </tr>
                   


                            <?php


                            

                        }
                    }
                    else
                    {
                        //order not available
                        echo "<tr><td colspan='12' class='error'>Orders Not Availablle</td></tr>"; 
                    }
                    
                    ?>


                    



                </table>
</div>
</div>
<?php include('partials/footer.php');?>
