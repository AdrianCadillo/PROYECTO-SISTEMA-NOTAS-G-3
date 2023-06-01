<?php 
namespace lib;

trait Session 
{
    /** Creamos la session  */

    public function Session(string $Namsession,$Valor)
    {
      $_SESSION[$Namsession] = $Valor;
    }

     /** Recuperamos el valor de la session  */

     public function getSession(string $NameSession)
     {
        return isset($_SESSION[$NameSession]) ? $_SESSION[$NameSession]:'';
     }

     /** Validar la existencia de la variable de session  */

     public function ExistSession(string $NameSession)
     {
        return isset($_SESSION[$NameSession]);/// bool (true false)
     }

     /** Eliminamos la variable de session  */

     public function destroySession(string $NameSession)
     {
          if($this->ExistSession($NameSession))
          {
            unset($_SESSION[$NameSession]);
          }
     }

     public function old(string $Input)
     {
        $Valor = "";

        if($this->ExistSession($Input))
        {
          $Valor = $this->getSession($Input);
          $this->destroySession($Input);
        }

        return $Valor;
     }
}