<?php
    //*
    // CS75 Project 0 - PizzaML
    //  Justin Deardorff
    // menu controller for main site
    //
    
    require("../includes/functions.php");
    
    //check to make sure a valid category was passed, if not, send them back to index
    if($_GET["categoryname"] == '' OR $_GET["categoryname"] == null)
    {
        render("index.php");
    }
    else //load up the vars and prepare to send them on to view the selected items
    {
        //store get vars locally for passing
        $catname = $_GET["categoryname"];
        $catdesc = $_GET["categorydesc"];
        
        if($catname=="Pizzas & Specialty Pizzas")
        {
            $extracheese=1;
        }
        else
        {
            $extracheese=0;
        }
    }
    
    //load xml
    $xml=simplexml_load_file("../includes/menu2.xml") or die("Error: Cannot create object");
    
    //render menuview template to display selected menu item
    render("menuview.php", ["xml"=>$xml, "catname"=>$catname, "catdesc"=>$catdesc, "extracheese"=>$extracheese]);
?>

