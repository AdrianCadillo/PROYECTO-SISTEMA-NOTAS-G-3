<?php 
use lib\BaseController;
use models\Usuario;
use repository\implementacion\Model;

class UsuarioController extends BaseController
{
    private Model $ModelUser;
    public function create($saludo)
    {
       //$data = "hola desde create, VISTA $saludo" ;

       $this->ModelUser = new Usuario;

       echo "<pre>";
       
       print_r($this->ModelUser
       ->all()); 
       echo $this->ModelUser->Insert([
        "username"=>"Abelardo Adrian",
        "email"=>"adrian@gmail.com",
        "pasword"=>password_hash("12345678",PASSWORD_BCRYPT),
        "rol"=>"Administrador"
       ]);
       echo "</pre>";
       return;
       $this->View("usuario.Create");
    }
}