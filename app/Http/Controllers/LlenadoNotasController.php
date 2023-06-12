<?php 
use lib\BaseController;
use models\Estudiante;
use repository\implementacion\Model;

class LlenadoNotasController extends BaseController
{
   private Model $ModelEstudiante; 
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();

    $this->NoAuth();

    $this->ModelEstudiante = new Estudiante;
  }

  /// método para visualizar los estudiantes inscritos a un curso

  public function mostrarEstudiantesInscritos()
  {
        /// validar el token

        if ($this->getValidateToken($this->post("token_"))) {
            $Semestre_Id = $this->getSemestre()[0]->id_semestre_academico;

            $Curso_Id = $this->post("curso_id");

            $Estudiantes = $this->ModelEstudiante->procedure("proc_estudiantes_inscritos_por_curso", "c", [$Semestre_Id, $Curso_Id]);

            echo json_encode([
                "response" => $Estudiantes,
                "status" => 200
            ]);
        }
    }
}

