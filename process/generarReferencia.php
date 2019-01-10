<?php
ini_set('date.timezone',"America/Mexico_City");
function referencia($completador, $cuenta, $dinero,$curso){
  $hoy = date('Y-m-j'); //formato de fecha
  $fecha_limite_pago = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
  $year = date("Y", $fecha_limite_pago);
  $month= date("m", $fecha_limite_pago);
  $day = date("j", $fecha_limite_pago);
  //dígito fecha
  $fechaConversion= (($year-2000)*372)+(($month-1)*31)+($day-1);
  $cantidad =str_replace(".", "", $dinero);
  $array  = array_map('intval', str_split($cantidad));
  $ponderados = array();
  $ponderado=7;
  for ($i = 0; $i <count($array); $i++) {
    array_push($ponderados, $ponderado);
      if($ponderado==7){
        $ponderado=3;
      }else if($ponderado==3){
        $ponderado=1;
      }else{
        $ponderado=7;
      }
  }

  $reversed = array_reverse($ponderados);
  $ponderadosCantidad = array();
  for ($i = 0; $i <count($array); $i++) {
    array_push($ponderadosCantidad, $array[$i]*$reversed[$i]);
  }
  $cantidadReferencia=array_sum($ponderadosCantidad);
  //dígito cantidad
  $residuo=$cantidadReferencia % 10;
  //numero de referencia
  //$referencia="152467463641842";
  $referencia="$completador"."$cuenta"."$curso"."$fechaConversion"."$residuo";

  $referenciaArray  = array_map('intval', str_split($referencia));
  $ponderadosReferencia=11;
  $referenciaPonderados = array();
  for ($i = 0; $i <count($referenciaArray); $i++) {
    array_push($referenciaPonderados, $ponderadosReferencia);
      if($ponderadosReferencia==11){
        $ponderadosReferencia=13;
      }else if($ponderadosReferencia==13){
        $ponderadosReferencia=17;
      }else if($ponderadosReferencia==17){
        $ponderadosReferencia=19;
      }else if($ponderadosReferencia==19){
        $ponderadosReferencia=23;
      }else{
        $ponderadosReferencia=11;
      }
  }
  $reversed2 = array_reverse($referenciaPonderados);
  $ponderadosvsReferencia = array();
  for ($i = 0; $i <count($referenciaPonderados); $i++) {
    array_push($ponderadosvsReferencia, $referenciaArray[$i]*$reversed2[$i]);
    $nuevo=$referenciaArray[$i]*$reversed2[$i];

  }
  $cantidadReferenciaPonderados=array_sum($ponderadosvsReferencia);
  //dígito cantidad
  $Comprobante=($cantidadReferenciaPonderados % 97)+1;
  $referenciaFinal= "";
  $referenciaFinal.= "$referencia";
  $referenciaFinal.= "$Comprobante";
  return $referenciaFinal;
}
?>
