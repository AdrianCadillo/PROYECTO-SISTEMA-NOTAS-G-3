<?php 

/// depuración de errores

ini_set("display_errors",1);

ini_set("log_errors",1);

ini_set("error_log","C:/laragon/www/sistema_notas/php_error.log");

use Dotenv\Dotenv;


require 'vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();

require 'app/setting/Config.php';
require 'autoload.php';


/*
function suma($num1,$num2)
{
    return $num1+$num2;
}

echo call_user_func_array("suma",[2,4]);*/