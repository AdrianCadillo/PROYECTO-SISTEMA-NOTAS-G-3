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

 /// primary key pk del modelo

 protected $primaryKey;
/*==================================
   Método all (muestra todo registro)
  
 ====================================*/

  public function Query()
  {
   $Tabla = $this->Tabla." $this->alias";  /// cuando es consulta le aplicamos alias al modelo
   self::$Query = "SELECT * FROM $Tabla";
   return $this;
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
        
        if(self::$PPS->rowCount() > 0)
        {
         return self::$PPS->fetchAll(\PDO::FETCH_OBJ)[0];
        }
        return [];
       } catch (\Throwable $th) {
         echo $th->getMessage();
       }finally{self::closeConexionBD();}
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
       }finally{self::closeConexionBD();}
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
    }finally{self::closeConexionBD();}
 }

 /// Método Update => UPDATE estudiante set nombres=:nombres,apellidos=:apellidos where id_estudiante=:id_estudiante

 public function Update(array $datos)
 {
   self::$Query = "UPDATE $this->Tabla SET ";

   /// le especificamos que atributos vamos a modificar

   foreach($datos as $atributo=>$value)
   {
      self::$Query.="$atributo=:$atributo,";
   }
   /// eliminamos la ultima coma

   self::$Query = rtrim(self::$Query,",")." WHERE ".array_key_first($datos)."=:".array_key_first($datos);

   /// el proceso de pdo para ejecutar dicha query

   try {
      self::$PPS = self::getConexion_()->prepare(self::$Query); 

      foreach ($datos as $key => $value) {
       self::$PPS->bindValue(":$key",$value);
      }
      
      return self::$PPS->execute(); /// 0 | 1

   } catch (\Throwable $th) {
      echo $th->getMessage();
   }finally{self::closeConexionBD();}
 }

 /// Método delete => DELETE FROM TABLA WHERE id

 public function delete($id)
 {
   
   self::$Query = "DELETE FROM $this->Tabla WHERE $this->primaryKey=:$this->primaryKey";

    /// el proceso de pdo para ejecutar dicha query
    
    try {
      self::$PPS = self::getConexion_()->prepare(self::$Query); 

      self::$PPS->bindParam(":$this->primaryKey",$id);
       
      return self::$PPS->execute(); /// 0 | 1

   } catch (\Throwable $th) {
      echo $th->getMessage();
   }finally{self::closeConexionBD();}
 }
}