<?php
     
    //if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //cast qty parameter as int.  Invalid values convert to 0, all others to int value
        $qtyint=intval($POST_["qty"]);
        
        //make sure posted qty is valid, non-zero,non-negative number, still checking the original string to make sure it was numeric
        if($_POST["qty"] == '' OR $_POST["qty"]<1 OR is_numeric($POST_["qty"])==FALSE)
        {
           render("apology.php", ["message" => "Please enter a valid quantity"]);
        } 
        else if($POST_["item"]=='') //check to make sure the item name is non-null
        {
           render("apology.php", ["message" => "Please select a valid item"]);
        }
        else //values seem valid, evaluate session and store
        {
        
            //convert price to remove $ sign
            $floatprice=getprice($POST_["price"]);
            $subtotal=$floatprice*$POST_["qty"];
            
            if(!isset($_SESSION["cartitem"]))
            {
                //if it's not set, let's just save the item as the first item in session
                //this makes the new product to add to the cart from your post params
                $cartitem = array
                (
                  
                  array('category'=>$POST_["category"],
                  		'itemname'=>$POST_["item"], 
                  		 'size' =>$POST_["size"],
                  		 'qty'=>$POST_["qty"],
                  		 'price'=>$POST_["category"],
                  		 'sauce'=>$POST_["sauce"],
                  		 'xcheese'=>$POST_["xcheese"],
                  		 'subtotal'=>$subtotal)
                );	
            }
        }
    }    
    else//else render order page with current info
    {
    
    }
     
?>    
