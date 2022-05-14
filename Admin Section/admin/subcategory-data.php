<?php 
        include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>
            SubCategory Data
        </h1>

        <br>
        <br>

        <table class="tbl-full">
                    <tr>
                        <th>
                            S.N.
                        </th>
                        <th>
                            Food Recipe ID
                        </th>
                        <th>
                            Food
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Subategory
                        </th>
                        <th>
                        Type(Traditional/Commercial)

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
                            Author ID
                        </th>
                        <th>
                            Author
                        </th>
                        
                        <th>
                            Status
                        </th>
                        <!--<th>
                            Featured
                        </th>
                        <th>
                            Active
                        </th>
                        
                        <th>
                            Verified
                        </th>-->
                        <th>
                            Actions
                        </th>
                    
                         
                        
                       
                    </tr>


     
        <?php


                //1.get the id of selected admin
                    $subcategory_id=$_GET['subcategory_id'];
                    $category_id=$_GET['category_id'];
                    

                    //get all the data from database
                    $sql="select * from tbl_food where (subcategory_id='$subcategory_id' and category_id='$category_id' )order by id desc";
                    
                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    //count the rows
                    $count=mysqli_num_rows($res);
                    $sn=1;

                    if($count>0)
                    {
                        //food recipe available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $food=$row['food'];
                            $time=$row['time'];
                            $type=$row['type'];
                            $user_id=$row['user_id'];

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
                            $sql3="select stitle from tbl_subcategory where subcategory_id='$subcategory_id'";
                            $res3=mysqli_query($conn,$sql3);
                            $count3=mysqli_num_rows($res3);
            

                            if($count3>0)
                            {
                                while($row3=mysqli_fetch_assoc($res3))
                                 {
                                    $stitle=$row3['stitle'];
                                }
                            }
                            $sql4="select user_name from tbl_user where user_id='$user_id'";
                            $res4=mysqli_query($conn,$sql4);
                            $count4=mysqli_num_rows($res2);
                    

                    if($count4>0)
                    {
                        while($row4=mysqli_fetch_assoc($res4))
                        {
                        $author=$row4['user_name'];
                        }
                    }



                            $serving=$row['serving'];
                            $ingredients=$row['ingredients'];
                            $proce=$row['proce'];
                            $category_id=$row['category_id'];
                            $subcategory_id=$row['subcategory_id'];

                            
                            //$verified=$row['verified'];
                            
                            $image_name=$row['image_name'];
                            $status=$row['status'];
                            //$active=$row['active'];
                            //$featured=$row['featured'];



                            




                            

                            ?>
                            <tr>
                            <td style="text-align: center;"><?php echo $sn++; ?></td>

                                <td style="text-align: center;"><?php echo $id; ?></td>
                                <td style="text-align: center;"><?php echo $food; ?></td>
                                <td style="text-align: center;"><?php echo $title; ?></td>
                                <td style="text-align: center;"><?php echo $stitle; ?></td>


                                <td style="text-align: center;"><?php 
                                
                                //checked or not
                                if($type=="")
                                                {
                                                    //we do not have status info,display the error message
                                                    echo "<div class='error'>Unknown.</div>";
                                                    //$status=="Not Checked";
                                                   // echo "<label style='color:red;'>$status</label>";
                                                    
                                                }
                                if($type=="Traditional")
                                {
                                    echo "<label style='color:green;'>$type</label>";
                                }
                                
                                elseif($type=="Commercial")
                                {
                                    echo "<label style='color:blue;'>$type</label>";
                                }

                            
                            
                            if($type=="Both")
                                {
                                    echo "<label style='color:purple;'>$type</label>";
                                }

                            
                            ?></td>
                                <td style="text-align: center;"><?php echo $time; ?></td>
                                <td style="text-align: center;"><?php echo $serving;?></td>

                                
                                <td style="text-align: center;">
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
                                <td style="text-align: center;"><?php echo $user_id; ?></td>
                                <td style="text-align: center;"><?php echo $author; ?></td>

                                



                                
                    


                                <td style="text-align: center;"><?php 
                                
                                    //checked or not
                                    if($status=="")
                                                    {
                                                        //we do not have status info,display the error message
                                                        echo "<div class='error'>Not Checked.</div>";
                                                        //$status=="Not Checked";
                                                       // echo "<label style='color:red;'>$status</label>";
                                                        
                                                    }
                                    if($status=="Checked")
                                    {
                                        echo "<label style='color:green;'>$status</label>";
                                    }
                                    
                                    elseif($status=="Not Checked")
                                    {
                                        echo "<label style='color:red;'>$status</label>";
                                    }

                                
                                ?></td>


                          <!--  <td style="text-align: center;"> <?php 
                                                //check whether the featured info is available or not
                                                    if($featured=="")
                                                    {
                                                        //we do not have info,display the error message
                                                        
                                                        echo "No";
                                                        
                                                    }
                                                    else{
                                                        echo $featured;
                                                    }
                                                    ?></td>
                            <td style="text-align: center;"> <?php 

                                                    if($active=="")
                                                    {
                                                        //we do not have active info,display the error message
                                                        
                                                        echo "No";
                                                        
                                                    }
                                                    else{
                                                        echo $active;
                                                    }
                                                    ?></td>
                            <td style="text-align: center;"> <?php
                                                    if($verified=="")
                                                    {
                                                        //we do not have verifid info,display the error message
                                                        
                                                        echo "No";
                                                        
                                                    }
                                                    else{
                                                        echo $verified;
                                                    }
                                                    ?></td>-->

                                                    
                                            
                                                    
                                

                                
                                <td style="text-align: center;"><a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" ><img src="../images/rec/edit.png" alt="Edit"  style="width:18px;height:18px;"></a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" ><img src="../images/rec/delete.png" alt="Delete"style="width:23px;height:23px;"></a>
                                </td>

                                

                                
                                
                                
                                

                            </tr>
                   


                            <?php


                            

                        }
                    }
                    else
                    {
                        //recipe not available
                        echo "<tr><td colspan='12' class='error'>Recipe Not Availablle</td></tr>"; 
                    }
                    
                    ?>


                    



                </table>
    </div>
</div>
<?php 
        include('partials/footer.php');
?>