<?php

use lib\BaseController;
use models\SemestreAcademico;
use repository\implementacion\Model;

class SemestreAcademicoController extends BaseController
{
  private Model $ModelSemestre;
  /// inicializar el contructor
  public function __construct()
  {
    parent::__construct();

    $this->NoAuth();

    $this->ModelSemestre = new SemestreAcademico;
  }


  public function index()
  {
    $SemestreAcademicos = $this->ModelSemestre->Query()
      ->select(
        "id_semestre_academico",
        "name_semestre_academico",
        "date_format(fecha_inicio_inscripcion,'%d/%m/%Y') as FII",
        "date_format(fecha_cierre_inscripcion,'%d/%m/%Y') as FCI",
        "date_format(fecha_inicio_llenadonotas,'%d/%m/%Y') as FIN",
        "date_format(fecha_cierre_llenadonotas,'%d/%m/%Y') as FCN"
      )->get();

    $this->View("semestre.index", compact("SemestreAcademicos"));
  }
  /// mostrar la vista del semestre academico (crear)

  public function create()
  {
    $this->View("semestre.create");
  }

  /// método para registrar un semestre academico

  public function store()
  {
    /// validamos el token
    if ($this->getValidateToken($this->post("token_"))) {
      $this->Session("mensaje", $this->ModelSemestre->Insert($this->RequestAll()));

      /// redirigir 

      $this->RedirectTo("semestreacademico");
    }
  }

  public function editar($id = null)
  {
    if ($id != null) {
      $SemestreAcademico = $this->ModelSemestre->Query()
        ->Where("id_semestre_academico", "=", $id)->first();

      if ($SemestreAcademico) {
        $this->View("semestre.editar", compact("SemestreAcademico"));
      }
    } else {
      $this->RedirectTo("semestreacademico");
    }
  }

  public function update($id)
  {
    /// validamos el token
    if ($this->getValidateToken($this->post("token_"))) {

      $this->Session("mensaje", $this->ModelSemestre->Update([
        "id_semestre_academico"=>$id,
        "name_semestre_academico"=>$this->post("name_semestre_academico"),
        "fecha_inicio_inscripcion"=>$this->post("fecha_inicio_inscripcion"),
        "fecha_cierre_inscripcion"=>$this->post("fecha_cierre_inscripcion"),
        "fecha_inicio_llenadonotas"=>$this->post("fecha_inicio_llenadonotas"),
        "fecha_cierre_llenadonotas"=>$this->post("fecha_cierre_llenadonotas")
      ]));

      

      /// redirigir 

      $this->RedirectTo("semestreacademico");
    }
  }
}
