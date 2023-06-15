<?php 
namespace models;
use repository\implementacion\Model;

class Nota extends Model
{
    protected $alias = "as n";/// alias de la tabla referente al modelo
    protected $Tabla = "notas";

    protected $primaryKey = "id_nota";
}