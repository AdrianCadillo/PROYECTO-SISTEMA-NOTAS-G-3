<?php 
namespace repository\report;

interface Orm 
{
 /*==================================
   Método para insertar datos en las tablas["clave"=>valor]
 ====================================*/
 public function Insert(string $Tabla,array $datos);
}