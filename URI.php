<?php

/**
 * URI Class
 *
 * analyse uri and decide route 
 */

class CI_URI {
	
	//original uri
    var $segments = array();
	
	// route infomation
    var $uri_string;
	
	// uri after deal
    var $rsegments;

    function fetch_uri_string() {
        if ($uri = $this->detect_uri()) {
            $this->set_uri_string($uri);
            return;
        }

    }

    /**
     * Set 
     * @param [type] $str [description]
     */
    function set_uri_string($str) {
        $this->uri_string = ($str == '/') ? '' : $str;
    }


    /**
     * --------------------------------------------------------------------
     * get  uri ，and acording uri invoke corresponding method
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

        // clear  '//' or '../' 
        return str_replace(array('//', '../'), '/', trim($uri, '/'));
    }

    

    function explode_uri() {

        foreach (explode('/', preg_replace("|/*(.+?)/*$|", "\\1", $this->uri_string)) as $val) {
            $val = trim($val);
            if ($val != '') {
                $this->segments[] = $val;
            }
        }
    }

}