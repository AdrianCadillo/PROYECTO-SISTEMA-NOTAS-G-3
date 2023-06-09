<?php 
namespace lib;

trait Fechas 
{
  /// obtenemos la fecha actual

  public function DateActual(string $formato)
  {
    $FechaActual = date($formato);// d-m-y ; Y-m-d

    /// strtotime, obtiene la cantidad de segundos desde 1970 hasta el momento de ejecución

    return date($formato,strtotime($FechaActual."-1 day"));
  }

  /// retornar el nombre del dia segun fecha

  public function getNameDia($fecha)
  {
    $FechaEnSegundos = strtotime($fecha);/// obtenemos la cantidad de segundos desde 1970 hasta el momneto de ejecución

    $DiaPorsemana = date("w",$FechaEnSegundos);/// dias de la semana , eso indica el w /// 0,1,2,3

    /// evaluamos con switch

    switch($DiaPorsemana)
    {
      case 0:return 'Domingo';
      case 1:return 'Lunes';
      case 2:return 'Martes';
      case 3: return 'Miercoles';
      case 4:return 'Jueves';
      case 5:return 'Viernes';
      case 6: return 'Sábado';
    }
  }

  /// obtener la una fecha sumando días 2023-06-08

  public function AddRestDate(string $formato,string $operacion)
  {
    $FechaActual = date($formato);

    return date($formato,strtotime($FechaActual."-1 day ".$operacion));
  }
   
}