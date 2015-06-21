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
    
    function getprice($price)
    {
         //strips leading dollar sign and non-numeric values and returns a float
         //courtesy of Steve at otopilo.net and http://php.net/manual/en/function.floatval.php#84590
         return $output = floatval(ereg_replace("[^-0-9\.]","",$price)); 
    }
    

?>
