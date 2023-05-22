<?php 
namespace setting;

use PDO;

class Conexion 
{
    public static string $Query;

    private static $Conector = null;

    private static $PPS = null;

    // realiza la conexión a la base de datos

    public static function getConexion_()
    {
       try {
        self::$Conector = new PDO(DRIVER,$_ENV["USERNAME"],$_ENV["PASSWORD"]);
        
        self::$Conector->exec("set names utf8");

       } catch (\Throwable $th) {
        echo $th->getMessage();
       }

       return self::$Conector;
    }


}