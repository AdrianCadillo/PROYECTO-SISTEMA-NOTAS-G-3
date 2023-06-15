<?php 
use lib\BaseController;
use models\Estudiante;
use models\Nota;
use repository\implementacion\Model;

class LlenadoNotasController extends BaseController
{
   private Model $ModelEstudiante,$ModelNota; 
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();

    $this->NoAuth();

    $this->ModelEstudiante = new Estudiante;

    $this->ModelNota = new Nota;
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

    /// método de ingreso de notas
    public function procesoLlenadoNotas()
    {
        if($this->getValidateToken($this->post("token_")))
        {
           /// Id del estudiante con respecto a un curso

           $Estudiante_Curso = $this->post("estudiante");

           /// las notas

           $PP = $this->post("pp");

           $PT = $this->post("pt");

           $EP = $this->post("ep");

           /// ["clave"=>valor] compact

           $Notas = compact("PP","PT","EP");
           

           foreach($Notas as $TipoNota=>$nota)
           {
            $Valor = $this->ModelNota->Insert([
                "nota"=>$nota,
                "tipo_nota"=>$TipoNota,
                "id_estudiante_curso"=>$Estudiante_Curso
            ]);
           }

           echo json_encode(["response"=>$Valor]);

        }
    }
}

