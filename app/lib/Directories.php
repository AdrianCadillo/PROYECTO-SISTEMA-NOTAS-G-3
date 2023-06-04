<?php 
namespace lib;

trait Directories 
{
  /// hacemos uso de Request

    use Request;
    private string $RaizPublicAsset= "public/asset/";

    private string $RaizComponents = "resources.views.components.";

    private string $RaizLayout = "resources.views.layout.";

    /// propiedad donde almacenaremos las imagenes

    private string $DirectorioFoto = "public/asset/fotos/";

    /// propiedad para obtener el nombre de la imagen
  
    private $NameImagen = null;
  
    /// imagenes aceptados
  
    private array $ImagenAccep = ["image/jpeg","image/png"];

    public function asset(string $file)
    {
      return URL_BASE.$this->RaizPublicAsset.$file;
    }

    public function getComponents(string $file)
    {
     return str_replace(".","/",$this->RaizComponents.$file).".blade.php";
    }

    public function layout(string $file)
    {
      return str_replace(".","/",$this->RaizLayout.$file).".blade.php";
    }

    ///  método que sube la foto al servidor
    public function UploadFoto(string $NameInputFoto)
    {
      /// primero verificamos si tenemos un archivo seleccionado

      if($this->file_size($NameInputFoto)>0)
      {
        /// verificamos que la caperta fotos exista, caso de no existir lo creamos

        if(!file_exists($this->DirectorioFoto))
        {
          /// creamos la carpeta y lo damos el permiso con true
          mkdir($this->DirectorioFoto,true);
        }

        /// verificamos que se una imagen jpg o png

        if(in_array($this->file_Type($NameInputFoto),$this->ImagenAccep))
        {
          /// creamos una imagen dependiendo del tipo
          if($this->file_Type($NameInputFoto) === $this->ImagenAccep[0])
          {
            $this->NameImagen = date("Ymd").rand().".jpg";
          }
          else{

            $this->NameImagen = date("Ymd").rand().".png";

          }

          /// formamos la ruta completa

          $this->DirectorioFoto.=$this->NameImagen;

          /// subimos al servidor la foto
          return move_uploaded_file($this->file_Content($NameInputFoto),$this->DirectorioFoto);

        }

        return 'no-accept';
      }
      return false;

    }

    /// método accesor para recuperar el nombre de la imagen

    public function getNameImagen()
    {
      return $this->NameImagen;
    }


    
}