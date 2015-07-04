<div>
    <div class="page-header"><h2><u>Your Order</u></h2></div>
    <p></p>
    <div class="default">
        <?php 
            
            {
                echo ("<br>");
                echo ("<h2><b>". $message . "</b></h2>");
                echo ("<br>");
                
                if(isset($_SESSION['cart']))
                {
                    displaycart();
                    echo ("<br>");
                    
                    if(!isset($total)) //if total is set, they have already checked out, don't display button
                    {
                        ?><a class="btn btn-default navbar-btn" href="checkout.php">Place Order</a><?php  
                    }
                }    
            
            }
            
        ?>
    </div>
</div>    
    
            
    
        
                
