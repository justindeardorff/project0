<?php
/**
*  Functions helper file
*  Renders pages, destroys sessions n'at
*  Written based on functions file provided by David Malan
*  CS75 Project0 PizzaML
**/

    function render($template, $values=[])
    {
        //if template exists, render it
        if (file_exists("../templates/$template"))
        {
            //extract vars into local scope
            extract($values);
            
            //render header
            require ("../templates/header.php");
            
            //render template
            require ("../templates/$template");
            
            //render footer
            require ("../templates/footer.php");
        }
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
