<?php
/**
 * --------------------------------------------------------------------
 * 获取 uri ，并通过 uri 调用相应的方法
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


    // 将路径中的 '//' 或 '../' 等进行清理
    return str_replace(array('//', '../'), '/', trim($uri, '/'));
}

$uri = detect_uri();
echo $uri;