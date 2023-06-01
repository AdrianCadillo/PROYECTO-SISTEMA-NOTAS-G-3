<?php 
namespace models;
use repository\implementacion\Model;

class Curso extends Model
{
    protected $alias = "as c";/// alias de la tabla referente al modelo
    protected $Tabla = "cursos";

    protected $primaryKey = "id_curso";
}