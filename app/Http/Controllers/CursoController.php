<?php 
use lib\BaseController;
use models\Curso;
use repository\implementacion\Model;

class CursoController extends BaseController
{
  private Model $ModelCurso;
  public function __construct()
  {
    parent::__construct();
    $this->ModelCurso = new Curso;
  }

  /// método index para mostrar la vista de cursos

  public function index()
  {
    $this->View("cursos.index");
  }
  /// método para registrar cursos

  public function save()
  {

    /// validamos el token
    if($this->getValidateToken($this->post("token_")))
    {
      /// validar existencia del curso

      $Curso_Name = $this->ModelCurso->Query()->Where("nombre_curso","=",$this->post("nombre_curso"))->first();

      echo $Curso_Name?json_encode(["response"=>"existe"])
           :json_encode(["response"=>$this->ModelCurso->Insert($this->RequestAll())]);

    }
  }

  /// mostrar los cursos
  public function showCursos()
  {
   
    /// validamos el token de envio
    if($this->getValidateToken($this->get("token_")))
    {
        /// traer desde la base d edatos las categorias existentes
        $Cursos = $this->ModelCurso->Query()->
        join("categorias as cat","c.id_categoria","=","cat.id_categoria")->
        Join("docentes as doc","c.id_docente","=","doc.id_docente")->get();

        echo json_encode([
            "cursos"=>$Cursos,
        ]);
    }
  }
}