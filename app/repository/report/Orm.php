<?php 
namespace repository\report;

interface Orm 
{
 /*==================================
   Método para insertar datos en las tablas["clave"=>valor]
 ====================================*/
 public function Insert(array $datos); /// ["name"=>"name usuario","email"=>""]

 /*==================================
   Método all (muestra todo registro)
 ====================================*/

 public static function all();

  /*==================================
   Método Where
 ====================================*/
 public function Where(string $atrubuto,$operador, string|int $valor);

/*==================================
   Método First
 ====================================*/

 public function first();

 public function get();

 public function Join(string $TablaFk,string $Fk,string $operador,string $PK);

 public function select();

 public function WhereOr(string $atrubuto,$operador, string|int $valor);


 public function OrderBy(string $atributo,$secuencia);

 /// Implementar el método Having y WhereAnd (Tarea)


 /// Método Update

 /// Método delete




}