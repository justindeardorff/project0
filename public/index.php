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
       
        <!-- used from bootstrap.  getbootstrap.com -->
        <div class="navbar navbar-default">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Three Aces Pizza</a>
            <!-- Small button group -->
            <div class="btn-group">
            <button class="btn btn-default btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Menu <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php
                //xml loader script from http://www.w3schools.com/php/php_xml_simplexml_read.asp
                
                $xml=simplexml_load_file("menu.xml") or die("Error: Cannot create object");
                //print_r($xml);
                foreach($xml->children() as $categories) { 
                    echo "<li><a href=";
                    echo $categories->categoryname . "php" . ">";
                    echo $categories->categoryname ;
                    echo "</a></li>" ;
                } 
                ?>
                
                <li><a href="#">Something else here</a></li>
            </ul>
            </div>
        </div>
   
    </body>
    
</html>    