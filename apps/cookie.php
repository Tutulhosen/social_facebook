<?php 
/**
 * set cookie message
 */
function setMgs($key, $mgs){
    setcookie($key, $mgs, time() + 2);
}

/**
 * get cookie mgs
 */
function getMgs($key){
    if (isset($_COOKIE[$key])) {
        echo "<p class=\"alert alert-dark\">{$_COOKIE[$key]}<button class=\"close\" data-dismiss=\"alert\">&times;</button></p>";
     }
}





?>