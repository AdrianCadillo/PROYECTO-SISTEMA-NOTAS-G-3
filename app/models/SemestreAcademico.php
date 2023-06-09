<?php 
namespace models;
use repository\implementacion\Model;

class SemestreAcademico extends Model
{
    protected $alias = "as s";/// alias de la tabla referente al modelo
    protected $Tabla = "semestre_academico";

    protected $primaryKey = "id_semestre_academico";
}