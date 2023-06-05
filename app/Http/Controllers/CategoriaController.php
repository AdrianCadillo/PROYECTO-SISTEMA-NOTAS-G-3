<?php 
use lib\BaseController;
use models\Categoria;
use repository\implementacion\Model;

class CategoriaController extends BaseController
{
  private Model $ModelCategoria;
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();

    $this->ModelCategoria = new Categoria;
  }

  /// método para mostrar las categorias

  public function showCategorias()
  {
    /// validamos el token de envio
    if($this->getValidateToken($this->get("token_")))
    {
        /// traer desde la base d edatos las categorias existentes
        $Categorias = $this->ModelCategoria->Query()->get();

        echo json_encode([
            "response"=>$Categorias,
            "status"=>200
        ]);
    }
  }
}
