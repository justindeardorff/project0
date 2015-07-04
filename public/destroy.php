<?php
     session_start();
     require_once("../includes/functions.php");
     destroysession();
     
     $message="Your Order Is Empty!";
     render("orderview.php", ["message"=>$message]);
 ?>
