<?php 
namespace lib;

trait Csrf 
{
  use Session; 
  /**** GENERAMOS EL TOKEN CSRF*/

  public function get_Csrf() 
  {

     $Token =bin2hex(openssl_random_pseudo_bytes(32));/// genera el token
     
     if(!$this->ExistSession("token"))
     {
      $this->Session("token",$Token);
     }

     return $this->getSession("token");
  }

  /*** VALIDE EL TOKEN */

  public function getValidateToken($token_)
  {
    if($this->ExistSession("token") and $this->getSession("token") === $token_)
    {
        return true;
    }

    // caso que el token del csrf no coincidan , muestra este error 405
    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    exit;
  }
}