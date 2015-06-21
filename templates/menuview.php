<div>
    <div class="page-header"><h2><u><?php echo $catname?></u></h2><p></p><small><?php echo $catdesc?></small></div>
    <p></p>
    <div class="default">
        
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
                                //if it's a non-pizza order
                               if($extracheese==0)  
                               {
                                   //check to see if it's a pasta order
                                   if($catname=="Spaghetti or Ziti" OR $catname=="Lasagna, Ravioli, or Manicotti")
                                   {
                                        ?>  <!-display order form with sauce type->
                                        <form class="form-inline" role="form" action="order.php" method="post">
                                            <div class="form-group">
                                                  <!--put item and price here-->
                                                  <?php
                                                   if($price["size"]=='')
                                                   {
                                                       echo " " . $price . " ";
                                                   }
                                                   else
                                                   {
                                                       echo strtoupper($price["size"]);
                                                       echo ("<br>");
                                                       echo $price;
                                                   }?>
                                           </div>
                                           <div class="form-group">
                                                <input type="number"  name="qty" value="1" min="1">
                                           </div>
                                           <select class="form-control" name="sauce">
                                              <option>Red Sauce</option>
                                              <option>White Sauce</option>
                                           </select>
                                           <div class="form-group">
                                                <input type="hidden" name=item value="<?php echo $menuitems->itemname;?>">
                                           </div>
                                           <div class="form-group">
                                                <input type="hidden" name=category value="<?php echo $catname;?>">
                                           </div>
                                           <div class="form-group">
                                                <input type="hidden" name=size value="<?php echo ($price["size"]);?>">
                                           </div> 
                                           <div class="form-group">
                                                <input type="hidden" name=price value="<?php echo $price;?>">
                                           </div>
                                           <button type="submit" class="btn btn-sm">Submit</button>
                                        </form>
                                      <?php  
                                   }
                                   else
                                   {    //put form for non-pizza, non-pasta orders here
                                   ?>
                                   <!-display order form with sauce type->
                                        <form class="form-inline" role="form" action="order.php" method="post">
                                            <div class="form-group">
                                                  <!--put item and price here-->
                                                  <?php
                                                   if($price["size"]=='')
                                                   {
                                                       echo " " . $price . " ";
                                                   }
                                                   else
                                                   {
                                                       echo strtoupper($price["size"]);
                                                       echo ("<br>");
                                                       echo $price;
                                                   }?>
                                           </div>
                                           <div class="form-group">
                                                <input type="number" name="qty" value="1" min="1">
                                           </div>
                                           <div class="form-group">         
                                                <input type="hidden" name="sauce" value="0">
                                           </div>
                                           <div class="form-group">
                                                <input type="hidden" name=category value="<?php echo $catname;?>">
                                           </div>
                                           <div class="form-group">
                                                <input type="hidden" name=item value="<?php echo $menuitems->itemname;?>">
                                           </div>
                                           <div class="form-group">
                                                <input type="hidden" name=size value="<?php echo ($price["size"]);?>">
                                           </div>     
                                           <div class="form-group">
                                                <input type="hidden" name=price value="<?php echo $price;?>">
                                           </div>
                                           <button type="submit" class="btn btn-sm">Submit</button>
                                        </form>
                                    <?php
                                    }
                                }    
                                else //this the area for pizza orders (shows extra cheese option)
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
                                            <input type="number" name="qty" value="1" min="1">
                                       </div>
                                       <div class="form-group">         
                                            <label><input type="checkbox" name="xcheese"> 2x Cheese</label>
                                       </div>
                                       <div class="form-group">         
                                            <input type="hidden" name="sauce" value="0">
                                       </div>
                                       <div class="form-group">
                                                <input type="hidden" name=category value="<?php echo $catname;?>">
                                       </div>
                                       <div class="form-group">
                                            <input type="hidden" name=item value="<?php echo $menuitems->itemname;?>">
                                       </div>
                                       <div class="form-group">
                                            <input type="hidden" name=size value="<?php echo ($price["size"]);?>">
                                       </div>     
                                       <div class="form-group">
                                                <input type="hidden" name=price value="<?php echo $price;?>">
                                       </div>
                                       <button type="submit" class="btn btn-sm">Submit</button>
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

