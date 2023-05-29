<?php 
use lib\BaseController;
use models\Estudiante;
use models\Usuario;
use repository\implementacion\Model;

class EstudianteController extends BaseController
{
    private Model $ModelUser,$ModelEstudiante;

    private array $WrningExist = [];
    public function create()
    {
       //$data = "hola desde create, VISTA $saludo" ;

       $this->View("usuario.Create");
    }

    /** registrar estudiantes  */

    public function save()
    {
        /// validamo si el token generado coincide con el token que envia el usuario

        if($this->getValidateToken($this->post("token_")))
        {
          $this->getValidateExist();
        }
    }

    /// validamos si existe registro de un usuario

    private function getValidateExist()
    {
      /// instanciar los modelos

      $this->ModelUser = new Usuario; // modelo usuario

      $this->ModelEstudiante = new Estudiante;

      /// validar la existencia de un usuario por username

      $Usuario_Username = $this->ModelUser->Query()
      ->Where("username","=",$this->post("username"))
      ->first();

      /// validar la existencia de un usuario por email

      $Usuario_Email = $this->ModelUser->Query()
      ->Where("email","=",$this->post("email_"))
      ->first();

      /// validar la existencia de un estudiante por dni

      $Estudiante = $this->ModelEstudiante->Query()
      ->Where("dni","=",$this->post("dni"))
      ->first();
  
      if($Usuario_Username)
      {
         $this->WrningExist[] ='Ya existe un usuario con el nombre usuario '.$this->post("username");
      }

      if($Usuario_Email)
      {
         $this->WrningExist[] ='Ya existe un usuario con el email '.$this->post("email_");
      }

      if($Estudiante)
      {
         $this->WrningExist[] ='Ya existe un estudiante con el DNI '.$this->post("dni");
      }

      /// si hay errores
      if(count($this->WrningExist) > 0)
      {
        /// le asigno a una variable de session

        $this->Session("existe",$this->WrningExist);
      }
      else
      {
        /// registrar

      }
       
    }
   
    private function UploadFoto()
    {

    }
}