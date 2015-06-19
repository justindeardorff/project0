<div name="body">
    <div class="page-header"><h2><u><?php echo $catname?></u></h2><p></p><small><?php echo $catdesc?></small></div>
    <p></p>
    <div>
        
                <?php

                    foreach($xml->xpath("/menu/categories/category[categoryname='{$catname}']/items/item") as $menuitems)
                    {
                       //display itemname and description
                       echo "<h4>" . $menuitems->itemname . "</h4>";
                       echo "<p></p>";
                       echo "<i>" . $menuitems->itemdesc . "</i>";
                       echo "<p></p>";
                       
                  
                       foreach($xml->xpath("//category[categoryname='{$catname}']/items/item[itemname='{$menuitems->itemname}']/prices") as $prices)
                       {
                            
                            foreach($prices->price as $price)
                            {
                               if($price["size"]=='')
                               {
                                   echo $price;?>
                                   <form action="order.php" method="post">
                                   <fieldset>
                                        <div class="input-group input-group-sm">
                                           <input type="number" class="form-control" name="qty" value="1" min="1">
                                           <button type="submit" class="btn btn-sm">Add To Order</button>
                                        </div>   
                                   </fieldset>
                               </form><?php
                                   echo ("<p>");
                               }
                               else
                               {
                                   echo $price["size"] . " - " . $price;?>
                                   <form action="order.php" method="post">
                                   <fieldset>
                                        <div class="input-group input-group-sm">
                                           <input type="number" class="form-control" name="qty" value="1" min="1">
                                           <button type="submit" class="btn btn-sm">Add To Order</button>
                                        </div>   
                                   </fieldset>
                               </form><?php
                                   echo ("<p>");
                               }
                               
                            }
                            echo ("<p>");
                       }
                       
                    }
                ?>
      
    </div>
</div>

