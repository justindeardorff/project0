<div name="body">
    <div class="page-header"><h2><u><?php echo $catname?></u></h2><p></p><small><?php echo $catdesc?></small></div>
    <p></p>
    <div class="">
        
                <?php

                    foreach($xml->xpath("/menu/categories/category[categoryname='{$catname}']/items/item") as $menuitems)
                    {
                       //display itemname and description
                       ?>
                       <div class="well well-sm">
                           <?php echo "<h4>" . $menuitems->itemname . "</h4>";?>
                           <?php echo "<p></p>";?>
                           <?php echo "<i>" . $menuitems->itemdesc . "</i>";?>
                           <?php echo "<p></p>";?>
                       </div>    
                       
                       <?php
                       
                       foreach($xml->xpath("//category[categoryname='{$catname}']/items/item[itemname='{$menuitems->itemname}']/prices") as $prices)
                       {
                            
                            foreach($prices->price as $price)
                            {
      
                               if($extracheese==0)
                               {
                                   //put form for non-pizza orders here
                                   ?>
                                   <form class="form-inline" role="form" action="order.php" method="post">
                                       <div class="form-group">
                                              <!--put item and price here-->
                                              <?php
                                               if($price["size"]=='')
                                               {
                                                   echo $price;
                                               }
                                               else
                                               {
                                                   echo strtoupper($price["size"]);
                                                   echo ("<br>");
                                                   echo $price;
                                               }?>
                                       </div>
                                       <div class="form-group">
                                            <input type="number" class="form-control" width="40" name="qty" value="1" min="1">
                                       </div>
                                       <div class="form-group">     
                                            <button type="submit" class="btn btn-sm">Submit</button>
                                      </div>  
                                  </form>
                                <?php
                                }
                                else
                                { 
                                    ?>
           
                                 <form class="form-inline" role="form" action="order.php" method="post">
                                       <div class="form-group">
                                              <!--put item and price here-->
                                              <?php
                                               if($price["size"]=='')
                                               {
                                                   echo $price;
                                               }
                                               else
                                               {
                                                   echo strtoupper($price["size"]);
                                                   echo ("<br>");
                                                   echo $price;
                                               }?>
                                       </div>
                                       <div class="form-group">
                                            <input type="number" class="form-control" width="40" name="qty" value="1" min="1">
                                       </div>
                                       <div class="form-group">         
                                            <label><input type="checkbox" name="xcheese" value="1"> 2x Cheese</label>
                                       </div>
                                       <div class="form-group">     
                                            <button type="submit" class="btn btn-sm">Submit</button>
                                      </div>  
                                  </form>
    
                                   <?php
                                }                     
                               
                            }
                            echo ("<p>");
                       }
                       
                    }
                ?>
 
    </div>
</div>

