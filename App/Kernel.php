<?php 

/* 
 * Kernel php 
 * autoloadlar  tanımlandı
*/

require __DIR__ . '/Config.php';
require __DIR__ . '/Database.php';

require __DIR__.'/Controllers/BaseController.php';
require __DIR__ . '/Models/BaseModel.php';

/*

function autoload_App($classname)
{
    $classname  = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classpath = __DIR__.DIRECTORY_SEPARATOR."App".DIRECTORY_SEPARATOR.$classname . ".php";
    if (is_readable($classpath)) {
        require $classpath;
    }
}


function autoload_Model($classname)
{
    $classname  = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classpath = __DIR__.DIRECTORY_SEPARATOR."App".DIRECTORY_SEPARATOR."Models".DIRECTORY_SEPARATOR.$classname . ".php";
    if (is_readable($classpath)) {
        require $classpath;
    }
}

function autoload_Controller($classname)
{
    $classname  = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classpath = __DIR__.DIRECTORY_SEPARATOR."App".DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR.$classname . ".php";
    if (is_readable($classpath)) {
        require $classpath;
    }
}


function autoload_Helpers($classname)
{
    $classname  = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classpath = __DIR__.DIRECTORY_SEPARATOR."App".DIRECTORY_SEPARATOR."Helpers".DIRECTORY_SEPARATOR.$classname . ".php";
    if (is_readable($classpath)) {
        require $classpath;
    }
}

function autoload_Validations($classname)
{
    $classname  = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classpath = __DIR__.DIRECTORY_SEPARATOR."App".DIRECTORY_SEPARATOR."Validation".DIRECTORY_SEPARATOR.$classname . ".php";
    if (is_readable($classpath)) {
        require $classpath;
    }
}

spl_autoload_register("autoload_App");
spl_autoload_register("autoload_Controller");
spl_autoload_register("autoload_Model");
spl_autoload_register("autoload_Helpers");
spl_autoload_register("autoload_Validations");

*/