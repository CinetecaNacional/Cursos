<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
$nombre= $_POST['nombre'];
$precio= $_POST['precio'];
$descripcion=$_POST['descripcion'];
$disponible ='';
if($_POST['disponible']=="Si"){
  $disponible= '1';
}else if($_POST['disponible']=="No"){
  $disponible= 'false';
}
$promocion= $_POST['promocion'];
$fecha= $_POST['fecha'];
if(!$nombre=="" && !$precio=="" && !$disponible==""){
  $verificar=  ejecutarSQL::consultar("select * from cursos where nombre='".$nombre."'");
  $verificaltotal = mysql_num_rows($verificar);
  if($verificaltotal<=0){
    if(!$promocion=="" && !$fecha==""){
      $promocion_disponible=1;
      if(consultasSQL::InsertSQL("cursos", "nombre, precio, descripcion, disponible, promocion, fecha_limite_promocion,promocion_disponible", "'$nombre','$precio','$descripcion','$disponible','$promocion','$fecha','$promocion_disponible'")){
        echo "<script>alert('Se ha registrado exitosamente el curso $nombre');
        location.href='index.php';
        </script>";
      }else{
        echo "<p>Ha ocurrido un error. Por favor intente nuevamente $nombre</p>";
      }
    }else{
      if(consultasSQL::InsertSQL("cursos", "nombre, precio, descripcion, disponible", "'$nombre','$precio','$descripcion','$disponible'")){
        echo "<script>alert('Se ha registrado exitosamente el curso $nombre');
        location.href='index.php';
        </script>";
      }else{
        echo "<p>Ha ocurrido un error. Por favor intente nuevamente</p>";
      }
    }
  }else{
    echo "<p>El nombre del curso proporcionado ya está registrado, Ingrese otro nombre de curso<p>";
  }
}else{
  echo "<p>No se ha completado el registro!, Hay un campo vacio</p>
  <script>alert($disponible);</script>";
}
?>
