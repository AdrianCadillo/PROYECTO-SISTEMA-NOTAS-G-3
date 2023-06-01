<?php 
namespace lib;

trait ProcesRoute 
{
 /// propiedad para asignar la raiz app controller

 private static string $RaizAppController = "app/Http/Controllers/";

 /*=========================
   Capturamos la ruta
 ===========================*/
 private static function getRoute()
 {
    if(isset($_GET['ruta']))
    {
       return explode("/",$_GET['ruta']); 
    }
 }
/*=========================
   Capturamos el controlador UsuarioController
 ===========================*/

 private static function getController()
 {
    return !empty(self::getRoute()[0]) ? ucwords(self::getRoute()[0])."Controller":'';
 }

 /*=========================
   Capturamos el Methodo UsuarioController
 ===========================*/

 private static function getMethod()
 {
    return !empty(self::getRoute()[1]) ? self::getRoute()[1]:'';
 }
 /*=========================
   Proceso para el enrutado y ejecutarlo
 ===========================*/

 public static function run()
 {
    // verificamos que el controlador exista

    if(!empty(self::getController()))
    {
        //obtengo el controlador
        $Controlador = self::getController();

        self::$RaizAppController.=$Controlador.".php";

       /// verificamos la existencia del archivo

       if(file_exists(self::$RaizAppController))
       {
         /// requerimos el archivo controller
         require self::$RaizAppController;

         if(class_exists($Controlador))
         {
            /// crear un objeto e instanciar la clase controlador

            $Objeto = new $Controlador;

            /// verifca que el método exista

            if(!empty(self::getMethod()))
            {
                $Methodo = self::getMethod();

               /// verificar si dicho método esta en el objeto 
               if(method_exists($Objeto,$Methodo))
               {
                 /// validaremos el método si posee parametros o no
                 self::getParams($Objeto,$Methodo);
               }
               else
               {
                echo "no existe el método en el objeto";
               }
            }
            else
            {
                $Objeto->index();
            }
         }
         else
         {
            echo "no existe la clase controlador";
         }
       }
       else
       {
        echo "no existe el archivo controller";
       }
    }
    else
    {
        echo "no especificaste el controlador";
    }
 }

 /*======================================= 
 Validación de parámetros del método
 =========================================*/

 private static function getParams($Objeto,$Methodo)
 {
  // obtener la cantidad lo que digite en la url
  $CantidadParametros = sizeof(self::getRoute());

  if($CantidadParametros > 2 )
  {
   $Parametros = [];
    /// método con paramatros
    
    for($i=2;$i<$CantidadParametros;$i++)
    {
        $Parametros[] = self::getRoute()[$i];
    }

   /// $Objeto->{$Methodo}($Parametros);// ([1,2,4])

    call_user_func_array(array($Objeto,$Methodo),$Parametros);
  }
  else
  {
    /// método sin parámetros
    $Objeto->{$Methodo}();
  }
 }
 

}
