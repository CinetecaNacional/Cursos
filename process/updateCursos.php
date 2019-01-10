<?php
session_start();
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
$curso_id= $_SESSION['curso_id'];
echo "$curso_id";
$nombre= $_POST['nombre'];
$precio= $_POST['precio'];
$descripcion= $_POST['descripcion'];
$disponible ='';
if($_POST['disponible']=="Si"){
  $disponible= '1';
}else if($_POST['disponible']=="No"){
  $disponible= 'false';
}
$promocion= $_POST['promocion'];
$fecha = $_POST['fecha'];

if(!$nombre=="" && !$precio=="" && !$disponible==""){
  if(!$promocion=="" && !$fecha==""){
    $promocion_disponible=1;
    if(consultasSQL::UpdateSQL("cursos", "nombre='$nombre', precio='$precio', descripcion='$descripcion', disponible='$disponible', promocion='$promocion', fecha_limite_promocion='$fecha',promocion_disponible='$promocion_disponible'", "cursos_id='$curso_id'")){
      echo "<script>alert('Se ha actualizado exitosamente el curso $nombre');
      location.href='index.php';
      </script>";
    }else{
      echo "<p>Ha ocurrido un error. Por favor intente nuevamente $nombre</p>";
    }
  }else{
    $promocion_disponible=0;
    $promocion= '';
    $fecha='';
    if(consultasSQL::UpdateSQL("cursos", "nombre='$nombre', precio='$precio', descripcion='$descripcion', disponible='$disponible',promocion='$promocion', fecha_limite_promocion='$fecha'", "cursos_id='$curso_id'")){
      echo "<script>alert('Se ha actualizado exitosamente el curso $nombre');
      location.href='index.php';
      </script>";
    }else{
      echo "<p>Ha ocurrido un error. Por favor intente nuevamente</p>";
    }
  }
}else{
  echo "<p>No se ha completado el registro!, Hay un campo vacio</p>";
}
?>
