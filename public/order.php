<?php session_start();
    
    require_once("../includes/functions.php");    
    
    //open menu.xml file and load into xml variable
    $xml=simplexml_load_file("../includes/menu2.xml") or die("Error: Cannot create object");
    
    //if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if(isset($_POST["cartaction"]))  //check to see if it's a qty update request
        {
            $itemnum=$_POST["itemnumber"];
            
            if($_POST["cartaction"]=="update")
            {
                
                //use the item num to adjust the qty and subtotal of the item
                $_SESSION["cart"][$itemnum]["qty"]=$_POST["qty"];
                $_SESSION["cart"][$itemnum]["subtotal"]=$_SESSION["cart"][$itemnum]["price"]*intval($_POST["qty"]);
                
                $message="Quantity updated";    
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
                          
            }
            else if($_POST["cartaction"]=="remove")
            {
                $count=0;
                //cycle through entire cart again and when you get to the itemnum to remove, just don't add it
                foreach($_SESSION['cart'] as $cart_item)
                {
                    if($count!=$itemnum)
                    {
                         $cart[]=array('category'=>$_SESSION["cart"][$count]["category"],
                              		 'itemname'=>$_SESSION["cart"][$count]["itemname"], 
                              		 'size' =>$_SESSION["cart"][$count]["size"],
                              		 'qty'=>$_SESSION["cart"][$count]["qty"],
                              		 'price'=>$_SESSION["cart"][$count]["price"],
                              		 'sauce'=>$_SESSION["cart"][$count]["sauce"],
                              		 'xcheese'=>$_SESSION["cart"][$count]["xcheese"],
                              		 'subtotal'=>$_SESSION["cart"][$count]["subtotal"]);
                    }
                    $count++;
                }
                
                //set SESSION['cart'] = to new cart
                $_SESSION["cart"]=$cart;
                
                $message="Item Successfully Removed";
                
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
                
            }
            
   
        }
        else //values seem valid, evaluate session and store
        {
        
            if($_POST["qty"] == '' OR $_POST["qty"]<1 OR is_numeric($_POST["qty"])==FALSE)
            {
               render("orderview.php", ["message" => "Please enter a valid quantity"]);
            } 
            
            $qtyint=intval($_POST["qty"]);
        
            //convert price to remove $ sign
            $floatprice=getprice($_POST["price"]);
            $subtotal=$floatprice*$_POST["qty"];
           
            
            //check if xcheese is set, if not, set to 0.  have to do this bc of how checkboxes work
            if(!isset($_POST["xcheese"]))
            {
               $_POST["xcheese"]=0;
            }
            if(empty($_SESSION['cart']))
            {
                //if it's not set, let's just save the item as the first item in session
                //this makes the new product to add to the cart from your post params
                //cart item add and update implementation inspired by github user pwdd 
                //https://github.com/pwdd/pizzaml
                $_SESSION['cart'] = array
                (
                  
                  array('category'=>$_POST["category"],
                  		'itemname'=>$_POST["item"], 
                  		 'size' =>$_POST["size"],
                  		 'qty'=>$_POST["qty"],
                  		 'price'=>$floatprice,
                  		 'sauce'=>$_POST["sauce"],
                  		 'xcheese'=>$_POST["xcheese"],
                  		 'subtotal'=>$subtotal)
                );
                
               
                //render menuview template to display selected menu item
                $message = "You have successfully added the first item to your cart";
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
            }
            //if it's not the first item, then we need to check to see if the item already exists in the cart
            //and if it does, update the value.  If not, we'll create two separate arrays (existing cart, new item)
            //and then merge the two to give us our FANCY new cart.
            else  
            {
                
               //add new item to array   
               $new_item[]=array('category'=>$_POST["category"],
                              		 'itemname'=>$_POST["item"], 
                              		 'size' =>$_POST["size"],
                              		 'qty'=>$_POST["qty"],
                              		 'price'=>$floatprice,
                              		 'sauce'=>$_POST["sauce"],
                              		 'xcheese'=>$_POST["xcheese"],
                              		 'subtotal'=>$subtotal);             		 
                              		 
                //compare new item against existing cart items and look for match
                $match=false; //sets var to false before search through cart begins
                
                foreach($_SESSION['cart'] as $cart_item)
                {
                    //if match found, update qty and subtotal of existing cart item
                    if($cart_item["category"]==$new_item[0]["category"] &&
                        $cart_item["itemname"]==$new_item[0]["itemname"] &&
                        $cart_item["size"]==$new_item[0]["size"] &&
                        $cart_item["sauce"]==$new_item[0]["sauce"] &&
                        $cart_item["xcheese"]==$new_item[0]["xcheese"])
                    {
                        $cart[]=array('category'=>$new_item[0]["category"],
                              		 'itemname'=>$new_item[0]["itemname"], 
                              		 'size' =>$new_item[0]["size"],
                              		 'qty'=>$cart_item["qty"] + $new_item[0]["qty"],
                              		 'price'=>$new_item[0]["price"],
                              		 'sauce'=>$new_item[0]["sauce"],
                              		 'xcheese'=>$new_item[0]["xcheese"],
                              		 'subtotal'=>$floatprice * ($cart_item["qty"] + $new_item[0]["qty"]));
                              		 
                        
                        $match=true; //update match var to true
                        
                    } 
                    else
                    {
                        $cart[]=array('category'=>$cart_item["category"],
                              		 'itemname'=>$cart_item["itemname"], 
                              		 'size' =>$cart_item["size"],
                              		 'qty'=>$cart_item["qty"],
                              		 'price'=>$cart_item["price"],
                              		 'sauce'=>$cart_item["sauce"],
                              		 'xcheese'=>$cart_item["xcheese"],
                              		 'subtotal'=>$cart_item["qty"]);
                    }                
                }
                
                //if there was no match, simply array merge to tack the new item on to the array
                if($match==false)
                {
                    $_SESSION['cart']=array_merge($cart, $new_item);
                }
                else //else the new cart is already made, set the var
                {
                    $_SESSION['cart']=$cart;
                
                }
                    
                $message="item successfully added to cart";    
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
                     
            }
        }
    }    
    else//else render order page with current info.  This is for when they click "order" in nav 
    {      
           if(!isset($_SESSION['cart']))
           {
                 //cart is empty, render orderview.php page with message
                 $message="The Cart is Empty";
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
           }
           else
           {
                $message="Your Current Order";
                render("orderview.php", ["xml"=>$xml, "message"=>$message]);
                
           }
 
    }
     
?>    
