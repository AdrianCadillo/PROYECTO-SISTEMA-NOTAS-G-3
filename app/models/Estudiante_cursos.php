<?php 
namespace models;
use repository\implementacion\Model;

class Estudiante_cursos extends Model
{
    protected $alias = "as ec";/// alias de la tabla referente al modelo
    protected $Tabla = "estudiante_cursos";

    protected $primaryKey = "id_estudiante_curso";
}