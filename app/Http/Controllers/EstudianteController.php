<?php 
use lib\BaseController;
use models\Curso;
use models\Estudiante;
use models\Estudiante_cursos;
use models\Usuario;
use repository\implementacion\Model;

class EstudianteController extends BaseController
{
    private Model $ModelUser,$ModelEstudiante,$Model_Estudiante_curso,$ModelCurso;

    private string $Destino_Foto = "public/asset/fotos/";

    private array $AcceptImagen =["image/jpeg","image/png"];
    private array $WrningExist = [];

    private string $NameImagen;

    private array $Errors = [];

    public function index()
    {
      /*
      $this->ModelEstudiante = new Estudiante;
      $estudiantes = $this->ModelEstudiante->Query()->get();*/
      $this->View("estudiante.index");
    }

    /// PARA MOSTRAR los datos en formato json de los estudiantes y sus cursos matriculados

    public function showEstudiante()
    {
      $this->ModelEstudiante = new Estudiante;

      $this->Model_Estudiante_curso = new Estudiante_cursos;

      $this->ModelCurso = new Curso;

      $Estudiante_Json = '';
      
      $Estudiantes = $this->ModelEstudiante->Query()->get(); /// obtengo todos los estuidantes
      foreach($Estudiantes as $estudiante)
      {
        $Estudiante_Json.= '{
          "id_estudiante":"'.$estudiante->id_estudiante.'",
          "dni":"'.$estudiante->dni.'",
          "estudiante":"'.$estudiante->apellidos.' '.$estudiante->nombres.'",
          "telefono":"'.$estudiante->telefono.'",
          "direccion":"'.$estudiante->direccion.'",
          "cursos_matriculados":[';
          foreach($this->Model_Estudiante_curso->Query()->Where("id_estudiante","=",$estudiante->id_estudiante)->get() as $estudiante_curso)
          {
            foreach($this->ModelCurso->Query()->Where("id_curso","=",$estudiante_curso->id_curso)->get() as $curso)
            {
              $Estudiante_Json.='"'.$curso->nombre_curso.'",';
            }
          }
          /// eliminamos la ultima coma
          $Estudiante_Json = rtrim($Estudiante_Json,",");

         $Estudiante_Json.=']},';  
      }

      /// eliminamos la ultima coma

      $Estudiante_Json = rtrim($Estudiante_Json,",");

      $Estudiante_Json = '{"estudiantes":['.$Estudiante_Json.']}';

      echo $Estudiante_Json;

    }
    public function create()
    {
       //$data = "hola desde create, VISTA $saludo" ;

       $this->View("estudiante.Create");
    }

    /** registrar estudiantes  */

    public function save()
    {
        /// validamo si el token generado coincide con el token que envia el usuario

        if($this->getValidateToken($this->post("token_")))
        {
         if($this->onClick("grabar"))
         {
          if(!empty($this->post("dni")))
          {
            $this->Session("dni",$this->post("dni"));
          }
          else{
            $this->Errors[] = "El campo dni es obligatorio";
          }

          if(!empty($this->post("nombres")))
          {
            $this->Session("nombres",$this->post("nombres"));
          }
          else{
            $this->Errors[] = "El campo nombres es obligatorio";
          }

          if(!empty($this->post("apellidos")))
          {
            $this->Session("apellidos",$this->post("apellidos"));
          }
          else{
            $this->Errors[] = "El campo apellidos es obligatorio";
          }

          if(!empty($this->post("username")))
          {
            $this->Session("username",$this->post("username"));
          }
          else{
            $this->Errors[] = "El campo username es obligatorio";
          }

          if(!empty($this->post("email_")))
          {
            $this->Session("email_",$this->post("email_"));

           if(!filter_var($this->post("email_"),FILTER_VALIDATE_EMAIL))
           {
            $this->Errors[] = "El campo email es incorrecto";
           }
          }
          else{
           $this->Errors[] = "El campo email es obligatorio";
          }

          /// validamoa si hay erroes almacenados

          if(count($this->Errors) > 0)
          {
            $this->Session("errores",$this->Errors);
          }else{
          $this->SaveEstudiante();
          }
         }
         $this->RedirectTo("estudiante/create");
         
        }
    }

    /// validamos si existe registro de un usuario

    private function SaveEstudiante()
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
        /// registrar un usuario

        $this->ModelUser->Insert([
          "username"=>$this->post("username"),
          "email"=>$this->post("email_"),
          "pasword"=>password_hash($this->post("password"),PASSWORD_BCRYPT),
          "rol"=>"Estudiante",
          "foto"=>$this->UploadFoto()?$this->NameImagen:null
        ]);

        /// obtenemos el usuario
        $Usuario = $this->ModelUser->Query()->Where("username","=",$this->post("username"))->first();

        /// registramos al estudiante

        $this->Session('mensaje',$this->ModelEstudiante->Insert([
          "dni"=>$this->post("dni"),
          "nombres"=>$this->post("nombres"),
          "apellidos"=>$this->post("apellidos"),
          "telefono"=>$this->post("telefono"),
          "direccion"=>$this->post("direccion"),
          "id_usuario"=>$Usuario->id_usuario
        ]));

      }
       
    }
   
    private function UploadFoto()
    {
       if($this->file_size("foto") > 0)
       {
         /// creamos el nuevo nombre de la imagen

         if(in_array($this->file_Type("foto"),$this->AcceptImagen))
         {
            if($this->file_Type("foto") === $this->AcceptImagen[0])
            {
              $TipoImagen = ".jpg";
            }
            else{
              $TipoImagen = ".png";
            }
         }
         else{
          echo "no es una imagen";
         }

         $this->NameImagen = date("Ymd").rand().$TipoImagen;

         $this->Destino_Foto.=$this->NameImagen;

         /// subir la imagen al servidor

         return move_uploaded_file($this->file_Content("foto"),$this->Destino_Foto);
       }
    }
}