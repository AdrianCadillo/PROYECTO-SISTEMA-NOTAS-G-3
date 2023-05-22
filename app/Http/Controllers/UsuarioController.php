<?php 
use lib\BaseController;

class UsuarioController extends BaseController
{
    
    public function create()
    {
       $data = "hola desde create";
       $this->View("usuario.Create",compact("data"));
    }
}