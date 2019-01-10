<?php
include './library/configServer.php';
include './library/consulSQL.php';
session_start();
error_reporting(E_PARSE);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Cursos en línea</title>
    <?php include './inc/link.php'; ?>
    <style>
    .botones{
      margin: 4% 0%;
    }
    </style>
  </head> 
  <body>
    <?php include './inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Actualizar mis datos personales</div>
    <div class="wrapper">
      <div class="container">
        <?php $id=$_SESSION['usuario_id'];
        $usuario=  ejecutarSQL::consultar("select * from usuarios where usuario_id=$id");
        while($datos_usuario=mysql_fetch_array($usuario)){
        echo '<form class=" FormCatElec login-form" action="process/updateInfo.php" method="post" role="form" data-form="login">
          <div class="form-group">
          <p class="texto-left">
            Apellido paterno:
            <input class="input" type="text" placeholder="Apellido paterno" name="apPaterno" minlength="2" maxlength="40" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" autofocus value="'.$datos_usuario['apellido_paterno'].'" oninput="upperCase(this)" title="Ingrese solo letras">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
          <label for="dynamic-label-input">Apellido materno:</label>
          <input class="input" type="text" placeholder="Apellido materno" name="apMaterno" minlength="2" maxlength="40" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" value="'.$datos_usuario['apellido_materno'].'" oninput="upperCase(this)" title="Ingrese solo letras">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Nombre:</label>
            <input class="input" type="text" placeholder="Nombre" name="nombre" minlength="2" maxlength="40"  required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" value="'.$datos_usuario['nombre'].'" oninput="upperCase(this)" title="Ingrese solo letras">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Curp:</label>
            <input class="input" id="curp_input" type="text" placeholder="Curp" name="curp" oninput="validarInput(this)"  minlength="18" required value="'.$datos_usuario['curp'].'">
            <p class="link"><a href="https://www.gob.mx/curp/" target="_blank" style="color:blue;">¿No conoces tu CURP?</a></p>
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Código postal:</label>
            <input class="input" type="text" name="cp" id="ZIP" placeholder="Código postal" required pattern="[0-9]{5}" value="'.$datos_usuario['codigo_postal'].'" title="El código postal debe de tener 5 dígitos">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Correo electrónico:</label>
            <input class="input" type="email" name="email" placeholder="Correo electrónico" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" value="'.$datos_usuario['correo_electronico'].'" title="user@dominio.extension">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Contraseña para entrar el sistema:</label>
            <input class="input" type="password" placeholder="Contraseña" name="contraseña">
            <pre style="color:gray; text-align:right;">Ingrese una nueva solo si desea cambiarla</pre>
          </p>
          </div>
          <div class="botones">
          <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
          <input type="submit" name="" value="Aceptar" class="btn" style="display:inline-block; width:45%;">
           <a href="./info.php"><button type="button" name="button" class="btn" style="display:inline-block; width:45%;">Cancelar</button></a>
          </div>
        </form>
      </div>
    </div>';}?>
    <?php include './inc/footer.php'; ?>
  </body>
</html>
