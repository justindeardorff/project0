<div class="panel panel-default">
    <div class="panel-heading"><h1><u><?php echo $catname?></u></h1><p></p><h3><i><?php echo $catdesc?></i></h3></div>
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
                                   echo $price;
                                   echo ("<p>");
                               }
                               else
                               {
                                   echo $price["size"] . " - " . $price;
                                   echo ("<p>");
                               }
                            }
                            echo ("<p>");
                       }
                       
                    }
                ?>
      
    </div>
</div>

