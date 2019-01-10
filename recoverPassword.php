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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" charset="utf-8"></script>
    <?php include './inc/link.php'; ?>
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/validarCurp.js" charset="utf-8"></script>
    <style>
    .texto-left{
      text-align: left;
      font-size:17px;
      font-family: 'Roboto', sans-serif;
    }
    a:visited{
    text-decoration: none;
    color: rgb(255, 255, 255);
    cursor: pointer;}
    .botones{
      margin: 4% 0%;
    }
    </style>
  </head>
  <body>
    <script>
      function enviar() {
        alert("Le hemos enviado un correo para que pueda restablecer su contraseña");
      }
    </script>
    <?php include './inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Actualizar mis datos personales</div>
    <div class="wrapper">
      <div class="container">
        <form class="login-form" action="" method="post">
          <div class="form-group">
            <p class="texto-left">
              <label for="dynamic-label-input">Correo:</label>
              <input class="input" type="text" name="email" placeholder="Correo electrónico" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="user@dominio.extension">
            </p>
          </div>
          <div class="botones">
            <input type="submit" name="" value="Aceptar" class="btn" style="display:inline-block; width:45%;">
            <a href="./login.php"><button type="button" name="button" class="btn" style="display:inline-block; width:45%;"> Cancelar</button></a>
          </div>

          </form>
      </div>
      </div>'

    <?php include './inc/footer.php'; ?>
  </body>
</html>
