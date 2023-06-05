<?php 
namespace models;
use repository\implementacion\Model;

class Docente extends Model
{
    protected $alias = "as doc";/// alias de la tabla referente al modelo
    protected $Tabla = "docentes";

    protected $primaryKey = "id_docente";
}