<?php 
use Dotenv\Dotenv;


require 'vendor/autoload.php';
require 'autoload.php';

Dotenv::createImmutable(__DIR__)->load();

require 'app/setting/Config.php';


/*
function suma($num1,$num2)
{
    return $num1+$num2;
}

echo call_user_func_array("suma",[2,4]);*/