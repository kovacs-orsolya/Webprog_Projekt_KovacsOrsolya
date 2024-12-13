<?php
//ToDo

spl_autoload_register(function ($class) {
    //echo $class;
    $file ="models/" . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }else {
        throw new Exception("Class $class not found");
    }
});