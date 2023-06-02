<?php 
namespace lib;

trait Directories 
{
    private string $RaizPublicAsset= "public/asset/";

    private string $RaizComponents = "resources.views.components.";

    private string $RaizLayout = "resources.views.layout.";

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
    
}