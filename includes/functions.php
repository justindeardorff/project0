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
    
    function displaycart($cart)
    {
        //write some code to iterate through array and print cart items to screen
        //print_r($cart);
        $itemcount=0;
            
            //I will need to implement a form control in each qty box to update the qty
            //I will need to implement a form control in each remove item box to completely
            //remove the item from the cart 
           ?> 
            
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Remove Item</th>
                 </thead>   
                 <tr>  
         <?php        
         foreach($cart as $item)
        {
            
            $itemcount++;?>  
            <tr>
                <td><?php echo($item["category"]);?></td>
                <td><?php echo($item["itemname"]);?></td>
                <td><form class="form" role="form" action="order.php" method="post">
                        <div class="form-group">
                            <input type="number"  name="qty" value="<?php echo ($item["qty"]);?>" min="1">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm">Update</button>
                     </form>    
                </td>
                <td><?php echo ($item["price"])?></td>
                <td><?php echo ($item["subtotal"])?></td>
                <td>Magic Button</td>      
             <tr>        
          <?php
	     } ?>  
           </table>
           <?php
	}?>
    
    


