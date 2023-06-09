<?php 
define("URL_BASE",$_ENV["BASE_URL"]);

define("DRIVER","mysql:host=".$_ENV["SERVER"].";dbname=".$_ENV["BASEDATOS"]);

define("PASS_CIFRADO",$_ENV['CLAVE_CIFRADO']);

define("METHODO_CIFRADO",$_ENV['METHOD_ENCRYPT']);

define("VIDA_COOKIE",time()+$_ENV['TIEMPO_VIDA_COOKIE']);