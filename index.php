<?php
/**
 * --------------------------------------------------------------------
 * get  uri £¬and acording uri invoke  corresponding method
 * --------------------------------------------------------------------
 */

function detect_uri() {
   
    if ( ! isset($_SERVER['REQUEST_URI']) OR ! isset($_SERVER['SCRIPT_NAME'])) {
        return '';
    }
	
	


    $uri = $_SERVER['REQUEST_URI'];	
    if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
        $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
    }
	
    if ($uri == '/' || empty($uri)) {
        return '/';
    }

    $uri = parse_url($uri, PHP_URL_PATH);
    // deal with  '//' or '../' 
    return str_replace(array('//', '../'), '/', trim($uri, '/'));
}


function explode_uri($uri) {

    foreach (explode('/', preg_replace("|/*(.+?)/*$|", "\\1", $uri)) as $val) {
        $val = trim($val);
        if ($val != '') {
            $segments[] = $val;
        }
    }
    return $segments;
}

class Welcome {

	function hello() {
		echo 'My first Php Framework!';
	}
}

$uri = detect_uri();
$uri_segments = explode_uri($uri);

$class = $uri_segments[0];
$method = $uri_segments[1];


// invoke class and method
$CI = new $class();
 
//echo detect_uri(); 
$CI->$method();

