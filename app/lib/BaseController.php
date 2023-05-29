<?php 
namespace lib;

class BaseController extends View 
{
    use Directories,Request,Csrf;

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
}