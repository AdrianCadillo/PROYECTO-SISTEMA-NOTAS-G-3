<?php 
namespace models;
use repository\implementacion\Model;

class Estudiante extends Model
{
    protected $alias = "as e";/// alias de la tabla referente al modelo
    protected $Tabla = "estudiantes";

    protected $primaryKey = "id_estudiante";
}