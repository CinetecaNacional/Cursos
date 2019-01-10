<?php
  session_start();
  error_reporting(E_PARSE);
  include './library/configServer.php';
  include './library/consulSQL.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cursos en línea</title>
    <?php include './inc/link.php'; ?>
  </head>
  <body>
    <?php include './inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Datos personales</div>
    <?php
    $usuario_id =$_SESSION['usuario_id'];
    $usuario=  ejecutarSQL::consultar("select * from usuarios where usuario_id = $usuario_id");
    if($usuario>0){
      while($datos_usuario=mysql_fetch_array($usuario)){
        $nombre = $datos_usuario['nombre'].' '.$datos_usuario['apellido_paterno'].' '.$datos_usuario['apellido_materno'];
        $cp =str_pad( $datos_usuario[codigo_postal], 5, "0", STR_PAD_LEFT);
        echo"
        <div style='font-size:18px;'>
        <p>Cuenta: $datos_usuario[cuenta]</p>
        <p>Nombre: $nombre</p>
        <p>Curp: $datos_usuario[curp]</p>
        <p>Sexo: $datos_usuario[sexo]</p>
        <p>Fecha de nacimiento: $datos_usuario[fecha_nacimiento]</p>
        <p>Código postal: $cp</p>
        <p>Correo electrónico: $datos_usuario[correo_electronico]</p>
        <a href='updateInfo.php'><button type='button' name='button' class='btn' style=' width:35%; margin-top:10px;'> Actualizar datos</button></a>
        </div>
        ";
      }
    }?>
    <?php include './inc/footer.php'; ?>
  </body>
</html>
