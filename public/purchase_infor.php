<?php 

    $cookie_name = "addToCart";
    if(isset($_COOKIE[$cookie_name])) {
        
        $productID = $_COOKIE[$cookie_name];
        $array = explode(",", $productID);
        $arraysize = sizeof($array);
    }
        
?>