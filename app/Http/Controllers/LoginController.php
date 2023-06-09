<?php 
use lib\BaseController;
use models\Usuario;
use repository\implementacion\Model;

class LoginController extends BaseController
{
  private Model $ModelUser;  
  private array $Errors = [];
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();

    $this->ModelUser = new Usuario;
  }

  /// mètodo que visualiza el formulario login
  public function index()
  {
    $this->Auth();

    $this->View("auth.login");
  }

  /// método para la acción de login al sistema
  public function SignIn()
  {
    if($this->getValidateToken($this->post("token_")))
    {
        /// proceso login
        
       if(empty($this->post("email")))
       {
        $this->Errors[] ='El email es necesario';
       }
       else
       {
        $this->Session("email",$this->post("email"));
       }

       if(empty($this->post("password")))
       {
        $this->Errors[] ='Ingrese su password';
       }

       if(count($this->Errors)>0)
       {
        $this->Session("errores",$this->Errors);

        $this->RedirectTo("login");
       }
       else
       {
        $this->Attemp($this->RequestAll());
       }
    }
  }

  /// proceso login
  private function Attemp(array $credenciales)
  {
    /// obtenemo al usuario
    $Usuario = $this->ModelUser->Query()->Where("email","=",$credenciales['email'])->first();

    /// verificamos si el usuario existe 

    if($Usuario)
    {
        /// verifico si lo que escribio el usuario coincide con el email de la base de datos

        if($Usuario->email === $credenciales['email'])
        {
            /// verifico el password
            if(password_verify($credenciales['password'],$Usuario->pasword))
            {
                /// proceso de recordar la session

               $Remember = !empty($this->post("remember"))?true:false;

               $this->RememberMe($Remember,$Usuario->id_usuario);

               /// redirigir

               $this->RedirectTo("curso");
            }
            else
            {
               $this->Session("mensaje","error en la contraseña");
            }
        }
        else
        {
            $this->Session("mensaje","error en el correo electónico");
        }
    }
    else
    {
        $this->Session("mensaje","el usuario con ese correo electronico no existe");
    }

    $this->RedirectTo("login");
  }

  public function logout()
  {
    $this->NoAuth();
    /// valdiamos el token

    if($this->getValidateToken($this->post("token_")))
    {
      if(isset($_COOKIE['remember']))
    {
       /// elimino la variable de la cookie
       unset($_COOKIE['remember']);
       
       setcookie("remember",null,VIDA_COOKIE-3600,"/");
    }

    session_destroy();

    /// redirigimos a login

    $this->RedirectTo("login");
    }
  }
  

}
