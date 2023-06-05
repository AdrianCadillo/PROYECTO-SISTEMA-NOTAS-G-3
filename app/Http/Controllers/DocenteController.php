<?php 
use lib\BaseController;
use models\Docente;
use models\Usuario;
use repository\implementacion\Model;

class DocenteController extends BaseController
{
    private Model $ModelDocente,$ModelUser;

    private array $WarningExiste =[];
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();

    $this->ModelDocente = new Docente;

    $this->ModelUser = new Usuario;
  }

  /// método para mostrar las categorias

  public function showDocentes()
  {
    /// validamos el token de envio
    if($this->getValidateToken($this->get("token_")))
    {
        /// traer desde la base d edatos las categorias existentes
        $Docentes = $this->ModelDocente->Query()->get();

        echo json_encode([
            "response"=>$Docentes,
            "status"=>200
        ]);
    }
  }

  /// método para registrar a un docente

  public function crearDocente()
  {
   /// validamos el token de envio
   
   if($this->getValidateToken($this->post("token_")))
   {
    /// verificar la existencia del docente por dni
    $Docente_Dni = $this->ModelDocente->Query()->Where("dni","=",$this->post("dni"))->first();

    /// verificar la existencia del usuario por username

    $UsuarioUsername = $this->ModelUser->Query()->Where("username","=",$this->post("username"))->first();

    /// verificamos la existencia del usuario por email

    $UsuarioEmail = $this->ModelUser->Query()->Where("email","=",$this->post("email_"))->first();

    if($Docente_Dni)
    {
      $this->WarningExiste[] ='Ese número de dni ya existe';
    }

    if($UsuarioUsername)
    {
      $this->WarningExiste[] ='El username '.$this->post("username").' ya existe';
    }

    if($UsuarioEmail)
    {
      $this->WarningExiste[] ='El email '.$this->post("email_").'  ya existe';
    }
    /// verificar si el array con elemntos

    if(count($this->WarningExiste) > 0)
    {
      echo json_encode([
        "response"=>$this->WarningExiste
      ]);
    }
    else
    {
      /// registrar al usuario y luego docente

      
      if($this->UploadFoto("foto")!== 'no-accept')
      {
        /// registrar un usuario

      $this->ModelUser->Insert([
        "username"=>$this->post("username"),
        "email"=>$this->post("email_"),
        "pasword"=>password_hash($this->post("password"),PASSWORD_BCRYPT),
        "rol"=>"Estudiante",
        "foto"=>$this->getNameImagen()
      ]);

      /// obtenemos el usuario
      $Usuario = $this->ModelUser->Query()->Where("username","=",$this->post("username"))->first();

      /// registramos al estudiante

       $DataInsert = $this->ModelDocente->Insert([
        "dni"=>$this->post("dni"),
        "nombres"=>$this->post("nombres"),
        "apellidos"=>$this->post("apellidos"),
        "telefono"=>$this->post("telefono"),
        "direccion"=>$this->post("direccion"),
        "id_usuario"=>$Usuario->id_usuario
       ]);

      echo json_encode([
        "response"=>$DataInsert
      ]);
      }
      else{
        echo json_encode([
          "response"=>"error-archivo"
        ]);
      }
    }
    
   }
   {

   }
  }
}

