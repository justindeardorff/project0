<?
    /*
    *  Three Aces Pizza Site
    *  CS75 Project 0
    *  Justin Deardorff
    *  Main entry point for site, directs users to menu items or checkout
    */
    // enable sessions
    session_start();
    
    // if form was actually submitted, check for error
     if (isset($_POST["action"]))
     {
        if (empty($_POST["name"]) || empty($_POST["gender"]) || empty($_POST["dorm"])) 
            $error = true;
     }
<?

<!DOCTYPE html>
 
<html>
 
    <head>
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>
 
        <?php if (isset($title)): ?>
            <title>Three Aces Pizza</title>
        <?php else: ?>
            <title>Three Aces Pizza</title>
        <?php endif ?>
 
        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
    </head>
    
    <body>
       
        <!-- used from bootstrap.  www.getbootstrap.com -->
        <div class="navbar navbar-default">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Three Aces Pizza</a>
            <!-- Small button group -->
            <div class="btn-group">
            <button class="btn btn-default btn-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Menu <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                 <?php
                //xml loader script from http://www.w3schools.com/php/php_xml_simplexml_read.asp
                
                $xml=simplexml_load_file("../includes/menu.xml") or die("Error: Cannot create object");
                //list element formatting  <li><a href="#">Something else here</a></li>
                foreach($xml->children() as $categories) 
                { 
                    echo "<li><a href=";
                    //link
                    echo "menu.php?categoryname=" . urlencode($categories->categoryname) . "&categorydesc=" . urlencode($categories->categorydesc) . ">"; //calls menu.php page passing categoryname var as GET
                    //menu caption
                    echo $categories->categoryname;
                    //ends list element
                    echo "</a></li>" ;
                } 
                ?>
            </ul>
            <button type="button" class="btn btn-default btn-lg">Your Order</button>
            </div>
        </div>
   
    </body>
    
</html>    
