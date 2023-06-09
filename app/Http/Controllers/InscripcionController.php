<?php 
use lib\BaseController;
use models\Curso;
use repository\implementacion\Model;

class InscripcionController extends BaseController
{
  /// inicializar el contructor
  private Model $Cursos;
 public function __construct()
  {
    parent::__construct();

    $this->NoAuth();

    $this->Cursos = new Curso;
  }

  public function index()
  {
   if($this->AperturaInscripcion())
   {
    $Cursos = $this->Cursos->procedure("proc_cursos_inscripcion","c",
    [
        $this->profile()->id_usuario
    ]);
    $this->View("inscripciones.index",["cursos"=>$Cursos]);
   }
   else{
    /// mostrar página 403
   }
  }
}

