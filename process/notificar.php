<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
$curso_id = $_POST['curso_id'];
$usuario_id = $_POST['usuario_id'];
if(!$curso_id=="" && !$usuario_id==""){
    if(consultasSQL::UpdateSQL("cursos_usuarios", "status=1", "usuario_id='$usuario_id' && curso_id= '$curso_id'")){
      echo "<script>alert('Se ha notificado a los administradores para que le den acceso al curso');";
    }else{
      echo "<p style='color:red;'>No se ha podido notificar, intentelo de nuevo</p>
      <script>alert('No se ha podido notificar, intentelo nuevamente');
      </script>";
    }
}else{
  echo "
  <script>alert('No se ha podido notificar');
  </script>";
}

?>
