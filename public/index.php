<?php
    //*
    // CS75 Project 0 - PizzaML
    //  Justin Deardorff
    // index controller for main site
    //*
    
    require("../includes/functions.php");
    
    //open menu.xml file and load into xml variable
    $xml=simplexml_load_file("../includes/menu.xml") or die("Error: Cannot create object");
    
    //render main
    render("main.php", ["xml"=>$xml]);
    
?>

