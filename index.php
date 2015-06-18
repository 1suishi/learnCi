<?php
/**
 *���
 */
require 'Router.php';
require 'URI.php';


$URI = new CI_URI();

$RTR = new CI_Router();

$RTR->set_routing();


$class = $RTR->fetch_class();
$method = $RTR->fetch_method();




$CI = new $class();

call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));

class Welcome {

    function hello() {
        echo 'My first Php Framework!';
    }

    function saysomething($str) {
        echo $str.", I'am the php framework you created!";
    }
}