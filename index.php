<?php

    function __autoload($className)
    {
        $class = str_replace('\\',DIRECTORY_SEPARATOR,$className);
        $file = "$class.php";
        //print($file.'<br>');
        include_once $file;
    }
    
//start = microtime(true);
    
    session_start();
    
    $control = 'bezoeker';
    if(isset($_REQUEST['control'])&&!empty($_REQUEST['control']))
    {
        $control = $_REQUEST['control'];
    }
    
    $action = 'default';
    if(isset($_REQUEST['action'])&&!empty($_REQUEST['action']))
    {
        $action = $_REQUEST['action'];
    }  
    
    $controllerName = 'infosysteem\controls'.'\\'.ucfirst($control).'Controller';
    $myControl = new $controllerName($control, $action);
    $myControl->execute();
    
//$end = microtime(true);
//$time = number_format(($end - $start), 2);
//echo 'This page loaded in ', $time, ' seconds';
