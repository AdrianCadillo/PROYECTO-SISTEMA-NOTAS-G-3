<?php 
use lib\BaseController;
class ConfiguracionController extends BaseController
{
  /// inicializar el contructor

  private array $ArchivoAccept = ["application/octet-stream"];
 public function __construct()
  {
    parent::__construct();
  }

  /// mostramos la vista de configuracion
  public function index()
  {
    $this->View("configuracion.index");
  }


  // generar la copia de seguridad ()

  public function CopiaSeguridad()
  {
    /// validar el token

    if($this->getValidateToken($this->post("token_")))
    {
        /// nombre de la copia de seguridad 

        $NameCopia = $this->post("copia").date("Ymd").rand();

        $NameCopia = str_replace(" ","_",$NameCopia);

        /// archivo sql
        $ArchivoSql = $NameCopia.".sql";

        /// comando para generar la copia de seguridad
        /// mysqldump

        $CommandCopiaSeguridad = "mysqldump --routines -h".$_ENV['SERVER']." -u".$_ENV['USERNAME']." -p".$_ENV['PASSWORD']." ".$_ENV['BASEDATOS']." > $ArchivoSql";

        system($CommandCopiaSeguridad,$respuesta);

        if($respuesta == 0)
        {
            /// creamos el archivo zip

            $Zipeado = new ZipArchive;

            /// le damos un nombre al archivo zip

            $NameArchivoZip = $NameCopia.".zip";

                /*===================madamos a descarga automática=============================*/

                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=" . basename($NameArchivoZip));
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");

            /// creamos el zip  a partir del nombre del zip

             if($Zipeado->open($NameArchivoZip,ZIPARCHIVE::CREATE)){

               $Zipeado->addFile($ArchivoSql); // añadimo el .sql
  
               $Zipeado->close(); // cerramos el zip
 
               unlink($ArchivoSql); /// eliminamos el archivo .sql

               /// eliminamos el bufffer generado
                ob_clean();
                flush(); 
  
                readfile(($NameArchivoZip)); // leemos el archivo zip

                unlink($NameArchivoZip);/// eliminamos el zip de  la raiz del proyecto   
             }
        }
    }
  }

  /// restaurar sistema

  public function restore(){

    if($this->getValidateToken($this->post("token_")))
    {
       if(in_array($this->file_Type("archivo_copia"),$this->ArchivoAccept))
       {
        /// realziamos el comando de restaurar sistema => mysql

        $CommandRestore = "mysql -h".$_ENV['SERVER']." -u".$_ENV['USERNAME']." -p".$_ENV['PASSWORD']." ".$_ENV['BASEDATOS']." < ".$this->file_Content("archivo_copia");

        /// ejecutamos el comando
        system($CommandRestore,$respuesta); /// 0 | 1

        if($respuesta == 0)
        {
            $this->Session("mensaje","1");
        }
        else
        {
            $this->Session("mensaje","0"); 
        }
       }
       else
       {
        $this->Session("error","Error a importar datos, el archivo es incorrecto");
       }

       /// redirigir 
       $this->RedirectTo("configuracion");
    }
  }
}