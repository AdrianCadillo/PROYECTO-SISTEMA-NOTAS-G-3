<?php 
namespace repository\implementacion;
use repository\report\Orm;
use setting\Conexion;

class Model extends Conexion implements Orm
{
 protected $Tabla;

 private $Value;

 private array $ValuesWhereOr = [];

 protected $alias; /// alias de la tabla
/*==================================
   Método all (muestra todo registro)
 ====================================*/

 public function __construct()
 {
   $this->Tabla.= " $this->alias";  /// cuando es consulta le aplicamos alias al modelo
   self::$Query = "SELECT * FROM $this->Tabla";
 }

 public static function all()
 {
   try {
    self::$PPS = self::getConexion_()->prepare(self::$Query);
    self::$PPS->execute();
    return self::$PPS->fetchAll(\PDO::FETCH_OBJ);
   } catch (\Throwable $th) {
     echo $th->getMessage();
   }
 }

 /*==================================
   Método Where
 ====================================*/
 public function Where(string $atributo,$operador,string|int $valor)
 {
    self::$Query.=" WHERE $atributo $operador ?";

    $this->Value = $valor;

    return $this;
 }

 /*==================================
   Método First
 ====================================*/

 public function first()
 {
    try {
        self::$PPS = self::getConexion_()->prepare(self::$Query);
        self::$PPS->bindParam(1,$this->Value);
        self::$PPS->execute();
        return self::$PPS->fetchAll(\PDO::FETCH_OBJ);
       } catch (\Throwable $th) {
         echo $th->getMessage();
       }
 }

 public function get()
 {
    
    try {
        self::$PPS = self::getConexion_()->prepare(self::$Query);

        if(!empty($this->Value))
        {
            self::$PPS->bindParam(1,$this->Value);
        }

        if(count($this->ValuesWhereOr) > 0)
        {
            for ($i=0; $i <count($this->ValuesWhereOr) ; $i++) { 
                self::$PPS->bindParam(($i+2),$this->ValuesWhereOr[$i]);
            }
        }
        self::$PPS->execute();
        return self::$PPS->fetchAll(\PDO::FETCH_OBJ);
       } catch (\Throwable $th) {
         echo $th->getMessage();
       }
 }

 public function Join(string $TablaFk,string $Fk,string $operador,string $PK)
 {
    self::$Query.= " INNER JOIN $TablaFk ON $Fk $operador $PK";
    return $this;
 }

 public function select()
 {
    $columnas = func_get_args();/// select("dni","nombres","apellidos") =>["dni","nombres","apellidos"]

    $columnas = implode(",",$columnas);/// "dni","nombres","apellidos"

    self::$Query = str_replace("*",$columnas,self::$Query);

    return $this;
 }

 public function WhereOr(string $atrubuto,$operador, string|int $valor)
 {
    self::$Query.= " OR $atrubuto $operador ?";

    $this->ValuesWhereOr[] = $valor;

    return $this;
 }


 public function OrderBy(string $atributo,$secuencia)
 {
    self::$Query.=" ORDER BY $atributo $secuencia";

    return $this;
 }

 //// INSERT INTO TABLA(atributo1,atributo2) VALUES(:atributo1,:atributo2)
 /// bindParam | bindValue

 public function Insert(array $datos)  
 {
    $this->Tabla = str_replace($this->alias,"",$this->Tabla);

    self::$Query = "INSERT INTO $this->Tabla(";

    foreach ($datos as $key => $value) {
      self::$Query.=$key.",";
    }

    /// eliminamos la ultima coma

    self::$Query = rtrim(self::$Query,",").") VALUES(";

    foreach ($datos as $key => $value) {
        self::$Query.=":$key".",";
    }

    /// eliminamos la ultima coma

    self::$Query = rtrim(self::$Query,",").")";

    try {
       self::$PPS = self::getConexion_()->prepare(self::$Query); 

       foreach ($datos as $key => $value) {
        self::$PPS->bindValue(":$key",$value);
       }
       
       return self::$PPS->execute(); /// 0 | 1
    } catch (\Throwable $th) {
       echo $th->getMessage();
    }


 }
}