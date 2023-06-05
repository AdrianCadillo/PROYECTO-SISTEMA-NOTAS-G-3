<?php 
namespace models;
use repository\implementacion\Model;

class Categoria extends Model
{
    protected $alias = "as cat";/// alias de la tabla referente al modelo
    protected $Tabla = "categorias";

    protected $primaryKey = "id_categoria";
}