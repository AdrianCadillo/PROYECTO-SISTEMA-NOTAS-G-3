<?php 
namespace lib;
trait Request 
{
    /*** Metodo que valida si un input tipo post esta definido */

    public function post(string $NameInput)
    {
        if(isset($_POST[$NameInput]))
        {
            return !empty($_POST[$NameInput]) ? $_POST[$NameInput]:'';
        }

        return null;
    }

    /*** Metodo que valida si un input tipo file esta definido */

    public function file(string $NameInput)
    {
        if(isset($_FILES[$NameInput]))
        {
            return $_FILES[$NameInput];
        }

        return null;
    }

    /** este método obteniene el tamaño del archivo */

    /*** Metodo que devuelve el tamaño del archivo */

    public function file_size(string $NameInput)
    {
         return $this->file($NameInput)['size'];
    }

    /*** Metodo que devuelve el tipo de archivo */

    public function file_Type(string $NameInput)
    {
         return $this->file($NameInput)['type'];
    }

     /*** Metodo que devuelve el archivo */

     public function file_Content(string $NameInput)
     {
          return $this->file($NameInput)['tmp_name'];
     }

     /*** Metodo que valida cuándo se da click en un boton */

     public function onClick(string $NameBoton):bool
     {
       return isset($_POST[$NameBoton]);
     }

     
}