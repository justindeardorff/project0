<?php
    require_once("../includes/functions.php");
    
    //if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //cast qty parameter as int.  Invalid values convert to 0, all others to int value
        $qtyint=intval($_POST["qty"]);
        
        //make sure posted qty is valid, non-zero,non-negative number, still checking the original string to make sure it was numeric
        if($_POST["qty"] == '' OR $_POST["qty"]<1 OR is_numeric($_POST["qty"])==FALSE)
        {
           render("apology.php", ["message" => "Please enter a valid quantity"]);
        } 
        else if($_POST["item"]=='') //check to make sure the item name is non-null
        {
           render("apology.php", ["message" => "Please select a valid item"]);
        }
        else //values seem valid, evaluate session and store
        {
        
            //convert price to remove $ sign
            $floatprice=getprice($_POST["price"]);
            $subtotal=$floatprice*$_POST["qty"];
            
            //check if xcheese is set, if not, set to 0.  have to do this bc of how checkboxes work
            if(!isset($_POST["xcheese"]))
            {
               $_POST["xcheese"]=0;
            }
            
            if(!isset($_SESSION["cartitem"]))
            {
                //if it's not set, let's just save the item as the first item in session
                //this makes the new product to add to the cart from your post params
                $cartitem = array
                (
                  
                  array('category'=>$_POST["category"],
                  		'itemname'=>$_POST["item"], 
                  		 'size' =>$_POST["size"],
                  		 'qty'=>$_POST["qty"],
                  		 'price'=>$_POST["category"],
                  		 'sauce'=>$_POST["sauce"],
                  		 'xcheese'=>$_POST["xcheese"],
                  		 'subtotal'=>$subtotal)
                );	
                
                //add code to render cart (add cartview template)
            }
            //if it's not the first item, then we need to check to see if the item already exists in the cart
            //and if it does, update the value.  If not, we'll create two separate arrays (existing cart, new item)
            //and then merge the two to give us our FANCY new cart.
            else  
            {
                //check to see if exists
                    //if exists, update value and subtotal
                    //else, add in new array and then merge using array_merge
                    
                //add code to render cart  (add cartview template)
                     
            }
        }
    }    
    else//else render order page with current info.  This is for when they click "order" in nav 
    {
           //add cartview template
    }
     
?>    
