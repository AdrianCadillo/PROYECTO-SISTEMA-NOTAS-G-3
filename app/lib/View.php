<?php 
namespace lib;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;

class View 
{
  // propiedad para entrar a la raiz de las vistas
  
  private static string $RaizView = "resources.views.";

  /** Método para proceso de mostrar con la libreria blade */
  
  public static function View(string $file,array $datos=[])
  {
    self::$RaizView = str_replace(".","/",self::$RaizView.$file).".blade.php";
    /// verificamos la existencia del archivo
    if(file_exists(self::$RaizView))
    {
        /// creamos un objeto para instanciar la clase Edge

        $Blade = new Edge(new EdgeFileLoader);

        echo $Blade->render(self::$RaizView,$datos);
    }
    else{

        echo json_encode([
            "response"=>"error page 404",
            "status"=>404
        ]);
    }
  }
}