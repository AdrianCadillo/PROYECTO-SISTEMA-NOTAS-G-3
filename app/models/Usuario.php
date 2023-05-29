<?php 
namespace models;
use repository\implementacion\Model;

class Usuario extends Model
{
    protected $alias = "as u";/// alias de la tabla referente al modelo
    protected $Tabla = "usuarios";

    protected $primaryKey = "id_usuario";
}