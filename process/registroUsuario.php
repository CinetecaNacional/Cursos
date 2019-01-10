<?php
  session_start();
  error_reporting(E_PARSE);
  include '../library/configServer.php';
  include '../library/consulSQL.php';

$apPaterno= $_POST['apPaterno'];
$apMaterno= $_POST['apMaterno'];
$nombre= $_POST['nombre'];
$curp= $_POST['curp'];
$codigoPostal= $_POST['cp'];
$email= $_POST['email'];
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
$password= $_POST['contraseña'];
$contraseña= $_POST['contraseña'];
if(!$apPaterno=="" && !$apMaterno=="" && !$nombre=="" && !$curp=="" && !$codigoPostal=="" && !$email==""&& !$fechaNacimiento==""&& !$contraseña==""){
  if($genero=="H"){
    $genero="Hombre";
  }else if($genero=="M"){
    $genero="Mujer";
  }
  $verificarCurp=  ejecutarSQL::consultar("select * from usuarios where curp='".$curp."'");
  $verificaltotalCurp = mysql_num_rows($verificarCurp);
  $verificarEmail=  ejecutarSQL::consultar("select * from usuarios where correo_electronico='".$email."'");
  $verificaltotalEmail = mysql_num_rows($verificarEmail);
  if($verificaltotalCurp<=0 && $verificaltotalEmail<=0){
    if(consultasSQL::InsertSQL("usuarios", "apellido_paterno, apellido_materno, nombre, curp, sexo, fecha_nacimiento, codigo_postal, correo_electronico, contraseña", "'$apPaterno','$apMaterno','$nombre','$curp','$genero','$fechaNacimiento','$codigoPostal', '$email','$contraseña'")){
      $consulta = ejecutarSQL::consultar("select * from usuarios where curp='".$curp."'");
        while($fila=mysql_fetch_array($consulta)){
          $cuenta=$fila['cuenta'];
          $_SESSION['nombre']=$nombre;
          $_SESSION['nombre']=$fila['usuario_id'];
          $_SESSION['cuenta']=$cuenta;
          echo "<script>alert('Usted se ha registrado exitosamente Su número de cuenta para ingresar es: $cuenta');
          logIn('$cuenta','$password');
            </script>";
        }
  }else{
      echo "<p style='color:red;'>Ha ocurrido un error. Por favor intente nuevamente</p>
      <script>
      alert('Ha ocurrido un error. Por favor intente nuevamente');
      </script>";

    }
  }else if($verificaltotalCurp>0){
    echo "<p style='color:red;'>El CURP proporcionado ya está registrado. Ingrese otro CURP o inicie sesión</p>
    <script>
      alert('El CURP proporcionado ya está registrado. Ingrese otro CURP o inicie sesión');
    </script>";
  }else{
    echo "<p style='color:red;'>El correo proporcionado ya está registrado. Ingrese otro correo electrónico o inicie sesión</p>
    <script>
      alert('El correo proporcionado ya está registrado. Ingrese otro correo electrónico o inicie sesión');
    </script>";
  }
}else{
  echo "<p style='color:red;'>No se ha completado el registro!. Hay un campo vacio</p>
  <script>
    alert('No se ha completado el registro!. Hay un campo vacio');
  </script>";
}
?>
