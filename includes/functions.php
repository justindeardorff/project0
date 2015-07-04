<?php
/**
*  Functions helper file
*  Renders pages, destroys sessions n'at
*  Written based on functions file provided by David Malan
*  CS75 Project0 PizzaML
**/

    function render($template, $values=[])
    {
        //if template exists, render it
        if (file_exists("../templates/$template"))
        {
            //extract vars into local scope
            extract($values);
            
            //render header
            require ("../templates/header.php");
            
            //render template
            require ("../templates/$template");
            
            //render footer
            require ("../templates/footer.php");
        }
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }
    
    function getprice($price)
    {
         //strips leading dollar sign and non-numeric values and returns a float
         //courtesy of Steve at otopilo.net and http://php.net/manual/en/function.floatval.php#84590
         $price = str_replace('$', '', $price);
         return $output = floatval($price);
    }
    
    function destroysession()
    {
        $_SESSION = array();
        session_destroy();
    }
    
    function displaycart()
    {
    
        $cart=$_SESSION["cart"];
        
        //counter used to uniquely identify cart items for updates or 
        $itemcount=0;

           ?> 
            
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Category/Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Remove Item</th>
                 </thead>   
                 <tr>  
         <?php        
         foreach($cart as $item)
        {
            
            ?>  
            <tr>
                <td><?php echo($item["category"]);?>
                    <?php echo ("<br>"); ?>
                    <?php echo("<b>".$item["itemname"]."</b>");?>
                </td>    
                <td><form class="form" role="form" action="order.php" method="post">
                        <div class="form-group">
                            <input type="number"  name="qty" value="<?php echo ($item["qty"]);?>" min="1">
                            <input type="hidden"  name="cartaction" value="update">
                            <input type="hidden"  name="itemnumber" value="<?php echo ($itemcount);?>">
                            
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm">Update Qty</button>
                     </form>    
                </td>
                <td><?php echo ("$".number_format($item["price"],2))?></td>
                <td><?php echo ("$".number_format($item["subtotal"],2))?></td>
                <td><form class="form" role="form" action="order.php" method="post">
                        <div class="form-group">
                            <input type="hidden"  name="cartaction" value="remove">
                            <input type="hidden"  name="itemnumber" value="<?php echo ($itemcount);?>">
                            <button type="submit" class="btn btn-sm">Remove Item</button>
                        </div>
                     </form>   
                </td>      
             <tr>        
          <?php $itemcount++;
	     } ?>  
           </table>
           <a class="btn btn-default navbar-btn" href="destroy.php">Clear Order</a>
           <?php
	}?>
    
    


