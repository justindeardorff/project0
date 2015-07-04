<?php session_start();
    //*
    // CS75 Project 0 - PizzaML
    //  Justin Deardorff
    // menu controller for main site
    //

    require_once("../includes/functions.php");
    
    //open menu.xml file and load into xml variable
    $xml=simplexml_load_file("../includes/menu2.xml") or die("Error: Cannot create object");
    
    //check to make sure a valid category was passed, if not, default to pizza menu
    if(!isset($_GET["categoryname"]))
    {
        //these are hardcoded. A less than optimal design decision should they choose to modify the category
        //or description in the future.  They would have to update both the XML and change these lines.
        //but I understand these risks and choose to do this rather than assign category ids to the list items
        //so that if the catname changes, this wouldn't break.
        $catname = "Pizzas & Specialty Pizzas";
        $catdesc = "Small and Large, add extra cheese to any Pizza for $1.25";
        $extracheese=1;    
 
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
 
    //render menuview template to display selected menu item
    render("menuview.php", ["xml"=>$xml, "catname"=>$catname, "catdesc"=>$catdesc, "extracheese"=>$extracheese]);
?>

