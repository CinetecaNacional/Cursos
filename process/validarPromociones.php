<?php
ini_set('date.timezone',"America/Mexico_City");
$hoy = getdate();
$fechaHoy = date_create($hoy['year']."-".$hoy['mon']."-".$hoy['mday']);
$cursos=  ejecutarSQL::consultar("select * from cursos where promocion_disponible=1");
if($cursos>0){
  while($cate=mysql_fetch_array($cursos)){
    $fechaPromocion = date_create($cate['fecha_limite_promocion']);
    $curso_id = $cate['cursos_id'];
    $interval = date_diff($fechaHoy, $fechaPromocion);
    if ($interval->format('%R%a')<=0) {
      consultasSQL::UpdateSQL("cursos", "promocion_disponible='0'", "cursos_id='$curso_id'");
    }
  }
}
?>
