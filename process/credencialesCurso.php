<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
$curso_id = $_POST['curso_id'];
$usuario_id = $_POST['usuario_id'];
$link_curso = $_POST['link_curso'];
$contrasena = $_POST['contrasena'];
$fecha = date('Y-m-j');
$vigencia_curso = strtotime ( '+9 week' , strtotime ( $fecha ) ) ;
$vigencia_curso = date ( 'Y-m-j' , $vigencia_curso );
if(!$curso_id=="" && !$usuario_id==""){
    if(consultasSQL::UpdateSQL("cursos_usuarios", "pago=1, link_curso='$link_curso', vigencia_curso='$vigencia_curso', contraseña='$contrasena'", "usuario_id='$usuario_id' && curso_id= '$curso_id'")){
      echo "<script>alert('Se han asignado las credenciales al usuario');
      location.reload(true);
      </script>";
    }else{
      echo "<p style='color:red;'>No se ha podido notificar, intentelo de nuevo</p>
      <script>alert('No se ha podido notificar, intentelo nuevamente');
      </script>";
    }
}else{
  echo "<script>alert('No se ha podido notificar');</script>";
}
echo "hola";
?>
