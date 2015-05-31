<?php
/**
 * --------------------------------------------------------------------
 * ��ȡ uri ����ͨ�� uri ������Ӧ�ķ���
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


    // ��·���е� '//' �� '../' �Ƚ�������
    return str_replace(array('//', '../'), '/', trim($uri, '/'));
}

$uri = detect_uri();
echo $uri;