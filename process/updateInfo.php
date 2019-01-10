<?php
session_start();
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
$id=$_SESSION['usuario_id'];
$apPaterno= $_POST['apPaterno'];
$apMaterno= $_POST['apMaterno'];
$nombre= $_POST['nombre'];
$curp= $_POST['curp'];
$email= $_POST['email'];
$cp=$_POST['cp'];
$contraseña= $_POST['contraseña'];

$genero= substr($curp, 10,1);
$dia= substr($curp, 4,2);
$mes= substr($curp, 6,2);
$año= substr($curp, 8,2);
$fechaNacimiento ="" ;
$fechaNacimiento.=$año;
$fechaNacimiento.="/ ";
$fechaNacimiento.=$mes;
$fechaNacimiento.="/ ";
$fechaNacimiento.=$dia;
if(!$apPaterno=="" && !$apMaterno=="" && !$nombre=="" && !$curp=="" && !$cp=="" &&!$email==""){
  if(!$_POST['contraseña']==""){
    if(consultasSQL::UpdateSQL("usuarios", "apellido_paterno='$apPaterno',apellido_materno='$apMaterno',nombre='$nombre',curp='$curp',sexo='$genero',fecha_nacimiento='$fechaNacimiento',codigo_postal='$cp',correo_electronico='$email',contraseña='$contraseña'", "usuario_id='$id'")){
      echo "<script>alert('Se han cambiado los datos exitosamente');
      location.href='info.php';</script>";
    }else{
      echo "<p style='color:red;'>No se ha podido cambiado los datos, intentelo nuevamente</p>
      <script>alert('No se ha podido cambiado los datos, intentelo nuevamente');
      </script>";
    }
  }else{
    if(consultasSQL::UpdateSQL("usuarios", "apellido_paterno='$apPaterno',apellido_materno='$apMaterno',nombre='$nombre',curp='$curp',sexo='$genero',fecha_nacimiento='$fechaNacimiento',codigo_postal='$cp',correo_electronico='$email'", "usuario_id='$id'")){
      echo "<script>alert('Se han cambiado los datos exitosamente');
      location.href='info.php';</script>";
    }else{
      echo "<p style='color:red;'>No se ha podido cambiado los datos, intentelo de nuevo</p>
      <script>alert('No se ha podido cambiado los datos, intentelo nuevamente');
      </script>";
    }
  }
}else{
  echo "<p style='color:red;'>No se ha podido cambiado los datos, Ha dejado un campo vacio</p>
  <script>alert('No se ha podido cambiado los datos, Ha dejado un campo vacio');
  </script>";
}
