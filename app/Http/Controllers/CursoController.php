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

    $this->NoAuth();
    
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
    if($this->getValidateToken($this->get("token_")))/// validamos el token para aplicar la acción de mostrar
    {
        /// traer desde la base d edatos las categorias existentes
        $Cursos = $this->ModelCurso->Query()->
        join("categorias as cat","c.id_categoria","=","cat.id_categoria")->
        Join("docentes as doc","c.id_docente","=","doc.id_docente")->get();

        /// enviamos en formato json
        echo json_encode([
            "cursos"=>$Cursos,
            "status"=>200
        ]);
    }
  }

  /// importar datos desde excel a la base de datos

  public function import()
  {
    if($this->getValidateToken($this->post("token_")))/// validamos el token para aplicar la acción de mostrar
    {
      
     if($this->file_size("archivo_excel") > 0)
     {
        if($this->file_Type("archivo_excel") === 'text/csv')
        {
         foreach($this->getDataExcel("archivo_excel") as $valueCurso)
         {
          $ExisteCurso = $this->ModelCurso->Query()->Where("nombre_curso","=",$this->_encode($valueCurso[0]))->first();
          if(!$ExisteCurso){
          $Valor = $this->ModelCurso->Insert([
            "nombre_curso"=>$this->_encode($valueCurso[0]),
            "descripcion"=>$this->_encode($valueCurso[1]),
            "id_categoria"=>$valueCurso[2],
            "id_docente"=>$valueCurso[3]
          ]);
         }
         else{
          $Valor = "existe";
         }
         }
          $this->Session("mensaje",$Valor);
          
        }
        else
        {
          $this->Session("errores","Error al importar datos, ya que el archivo seleccionado no es un excel");
        }
     }
     else
     {
       $this->Session("errores","Aún no seleccionaste un archivo excel");
     }

     /// redirijimos al index

     $this->RedirectTo("curso");
    }  
  }
}