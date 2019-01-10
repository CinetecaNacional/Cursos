<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
include 'generarReferencia.php';
session_start();
error_reporting(E_PARSE);
if (!$_SESSION['usuario_id'] == ""){
  $fecha = date('Y-m-j');
  $hoy = strtotime ( '+15 day' , strtotime ( $fecha ) ) ;
  $fecha_limite_pago= date("Y", $hoy).'-'.date("m", $hoy).'-'.date("j", $hoy);
  $usuario_id = $_SESSION['usuario_id'];
  $curso_id = $_POST['curso_id'];
  $curso_id_tres_ceros = str_pad($curso_id, 3, "0", STR_PAD_LEFT);
  $cursoInscrito =  ejecutarSQL::consultar("select * from cursos where cursos_id='".$curso_id."'");
  while($curso=mysql_fetch_array($cursoInscrito)){
    if($curso['promocion_disponible']==1){
      $precio = $curso['promocion'];
    }else{
      $precio = $curso['precio'];
    }
  }
  $cuenta= $_SESSION['cuenta'];
  $referencia = referencia('000',$cuenta,$precio,$curso_id_tres_ceros);
    $verificar=  ejecutarSQL::consultar("select * from cursos_usuarios where usuario_id='".$usuario_id."' && curso_id='".$curso_id."'");
    $verificaltotal = mysql_num_rows($verificar);
    if($verificaltotal<=0){
      if(!$precio=="" && !$fecha_limite_pago==""){
        $_SESSION['curso_id'] = $_POST['curso_id'];
        if(consultasSQL::InsertSQL("cursos_usuarios", "usuario_id, curso_id, precio,fecha_limite_pago, numero_referencia", "'$usuario_id','$curso_id','$precio','$fecha_limite_pago','$referencia'")){
          echo "<script>alert('Se ha inscrito exitosamente al curso');
          window.open('http://localhost/cursos/process/pagoCursoPDF.php', '_blank');
          location.href='myCourses.php';
          </script>";
        }else{
          echo "<p style='color:red; margin:15px; font-size:15px;>Ha ocurrido un error. Por favor intente nuevamente</p>";
        }
      }
    }else{
      echo "<p style='color:red; margin:18px; font-size:15px;'>Usted ya se ha inscrito con anterioridad, si su fecha de pago ha vencido solicite una nueva fecha de pago en la sección de mis cursos<p>
      <script>
        alert('Usted ya se ha inscrito con anterioridad, si su fecha de pago ha vencido solicite una nueva fecha de pago en la sección de mis cursos');
      </script>";
    }
} else {
  echo "<p style='color:black; font-size:25px; margin:10px 0px 0px 0px;'>Usted no ha iniciado sesión</p>
  <img src='assets/img/enviando.gif'>
  <p>Recargando<br>en 3 segundos</p>
  <script>
  alert('Necesita iniciar sesión para poder inscribirse al curso');
      setTimeout(function(){
      url ='logIn.php';
      $(location).attr('href',url);
    },3000);
  </script>";
}
?>
