<?php
     session_start();
     require_once("../includes/functions.php");
     
     $count=0;
     $total=0;
     //get order total
     foreach($_SESSION['cart'] as $cart_item)
     {
        $total+=$cart_item["subtotal"];
        $count++;
     }
     $total=number_format($total,2);
     
     $message="Your Order Has Been Submitted! <br> Order Total: $$total";
     render("orderview.php", ["message"=>$message, "total"=>$total]);
?>
