<?php
include 'generarReferencia.php';
$curso_id = 1;
$curso_id_tres_ceros = str_pad($curso_id, 3, "0", STR_PAD_LEFT);
$precio = 1563;
$cuenta= 180012;
$referencia = referencia('000',$cuenta,$precio,$curso_id_tres_ceros);
echo "$referencia";
$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '+15 day' , strtotime ( $fecha ) ) ;
$fechalimite= date("Y", $nuevafecha).'-'.date("m", $nuevafecha).'-'.date("j", $nuevafecha);
echo "$fechalimite";
?>
