<?php 
namespace lib;
use models\Estudiante;
use models\Usuario;

class BaseController extends View 
{
    use Directories,Csrf,Fechas;

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

    /// validar si el usuario esta uthenticado

    public function Auth()
    {
      if($this->ExistSession("remember") || isset($_COOKIE['remember']))
      {
        $this->RedirectTo("dashboard");
        exit;
      }
    }

    /// método si el usuario no está authenticado
    public function NoAuth()
    {
      if(!$this->ExistSession("remember") and !isset($_COOKIE['remember']))
      {
        $this->RedirectTo("login");
        exit;
      }
    }

    /// devuelve los datos del usuario Authenticado

    public function profile()
    {
      if($this->ExistSession("remember"))
      {
        $Id_Usuario = $this->getSession("remember");
      }

      if(isset($_COOKIE['remember']))
      {
        $Id_Usuario = openssl_decrypt($_COOKIE['remember'],METHODO_CIFRADO,PASS_CIFRADO);
      }

      /// CAPTURO AL USUARIO AUTHENTICADO

      $Usuario = new Usuario;

      return $Usuario->Query()->Where("id_usuario","=",$Id_Usuario)->first();
    }

    /// verifica el rol authenticado para dar permiso
    public function hasPermission(string $rol):bool
    {
      return $this->profile()->rol === $rol? true:false;
    }

    public function AperturaInscripcion()
    {
      $Estudiante = new Estudiante;

      return count($Estudiante->procedure("proc_valida_inscripcion","c"))>0 ? true:false;
    }

    public function AperturaLlenadoNotas()
    {
      $Estudiante = new Estudiante;

      return count($Estudiante->procedure("proc_valida_llenadonotas","c"))>0 ? true:false;
    }

    public function getSemestre()
    {
      $User = new Usuario;

      return $User->procedure("proc_Data_semestre","c");
    }

    /// obtener la data del excel

    public function getDataExcel(string $NameExcel):array
    {
      $NuevaData = [];
      /// es obtener la data del archivo excel

      $Data_Excel = file($this->file_Content($NameExcel));

     foreach($Data_Excel as  $key=>$Data)
     {
       if($key > 0)
       {
        $Data = explode(";",$Data);
        $NuevaData[]=$Data;
       }
     }

     return $NuevaData;

    }


    /// caracteres especiales 
    public function _encode(string $data)
    {
      return mb_convert_encoding($data,'UTF-8', 'ISO-8859-1');
    }



}