<?php 

/**************** Variable que va ser asignado la raiz de la carpeta app******* */

use lib\Route;//\ /

$RaizApp = "app/";
spl_autoload_register(function($file) use($RaizApp){

    $file = str_replace("\\","/",$file);

    $RaizApp.=$file.".php";
    
    if(file_exists($RaizApp))
    {
        require $RaizApp;
    }
});

echo "<pre>";
 Route::run() ;
 
echo "</pre>";