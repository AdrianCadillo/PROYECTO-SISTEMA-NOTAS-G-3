<?php 
namespace lib;

class BaseController extends View 
{
    use Directories,Request,Csrf;

    private string $NodeModules = "node_modules/";

    public function __construct()
    {
        // si no hay una session iniciada
        if(session_status()!=PHP_SESSION_ACTIVE)
        {
              session_start();
        }
    }

    public function route(string $routeController)
    {
      return URL_BASE.$routeController;
    }

    public function RedirectTo(string $routeController)
    {
      header("location:".URL_BASE.$routeController);
    }

    public function getNodeModules(string $file)
    {
       return URL_BASE.$this->NodeModules.$file;
    }

    public function getFoto($Foto)
    {
      if($Foto!=null)
      {
        return $this->asset("fotos/").$Foto;
      }

      return $this->asset("dist/img/avatar.png");

    }
}