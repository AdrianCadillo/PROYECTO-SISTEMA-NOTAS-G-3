<?php

use Http\pageextras\PageExtra;
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
   if($this->hasPermission("Estudiante"))
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
    PageExtra::Page403();
   }
   }
   else{
    PageExtra::PageNoAutorizado();
   }
  }

  /// realizar las inscripciones por estudiante
  public function inscribir()
  {
    if($this->getValidateToken($this->post("token_")))
    {
       /// validar de que por lo menos el estudiante seleccione un curso
       if(isset($_POST['curso']))
       {
        $Id_Usuario = $this->profile()->id_usuario;
        $Semestre_Id = $this->getSemestre()[0]->id_semestre_academico;
        foreach($_POST['curso'] as $miscursos)
        {
          $Value = $this->Cursos->procedure("proc_realizar_inscripcion","i",[$Id_Usuario,$Semestre_Id,$miscursos]);
        }

         $this->Session("mensaje",$Value);
       }
       else
       {
        $this->Session("error","Seleccione por lo menos un curso para realizar el proceso de inscripción");

       }

       /// redirigir

       $this->RedirectTo("inscripcion");
    }
  }
}

