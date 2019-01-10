<?php
include './library/configServer.php';
include './library/consulSQL.php';

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Cursos en línea</title>
    <?php include './inc/sesion.php';?>
    <?php include './inc/link.php';?>
  </head>
  <body>
    <?php include './inc/nav.php';?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Curso en línea</div>
    <div class="wrapper">
      <div class="container">
        <div class="login">Ya tengo cuenta</div>
        <div class="signup">Registro</div>
        <form action="process/login.php" method="post" role="form" class="FormCatElec login-form" data-form="login">
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Cuenta:</label>
            <input class="input" type="text" name="cuenta" placeholder="Número de cuenta" required autocomplete="off" autofocus>
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Contraseña:</label>
            <input class="input" type="password" name="contrasena" placeholder="Contraseña" autocomplete="off" required>
            </p>
          </div>
          <p class="link">
          <a href="./recoverPassword.php" style="color:blue;">He olvidado mi contraseña</a>
          </p>
          <br>
          <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
          <button type="submit" class="btn">Iniciar sesión</button>
          <!--<input type="submit"  value="Ingresar" class="btn">-->
        </form>
        <form class="signup-form FormCatElec" action="./process/registroUsuario.php" method="post" role="form"  data-form="save">
          <div class="form-group">
          <p class="texto-left">
            Apellido paterno:
            <input class="input" type="text" placeholder="Apellido paterno" name="apPaterno" minlength="2" maxlength="40" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" oninput="upperCase(this)" title="Ingrese solo letras">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
          <label for="dynamic-label-input">Apellido materno:</label>
          <input class="input" type="text" placeholder="Apellido materno" name="apMaterno" minlength="2" maxlength="40" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" oninput="upperCase(this)" title="Ingrese solo letras">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Nombre:</label>
            <input class="input" type="text" placeholder="Nombre" name="nombre" minlength="2" maxlength="40"  required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" oninput="upperCase(this)" title="Ingrese solo letras">
          </p>
          </div>
          <div class="form-group">
            <p class="texto-left">
              <label for="dynamic-label-input">Curp:</label>
              <input class="input" id="curp_input" type="text" placeholder="Curp" name="curp" oninput="validarInput(this)"  minlength="18" required>
              <p class="link"><a href="https://www.gob.mx/curp/" target="_blank" style="color:blue;">¿No conoces tu CURP?</a></p>
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Código postal:</label>
            <input class="input" type="text" name="cp" id="ZIP" placeholder="Código postal" required pattern="[0-9]{5}" title="El código postal debe de tener 5 dígitos">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Correo electrónico:</label>
            <input class="input" type="text" name="email" placeholder="Correo electrónico" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="user@dominio.extension">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Contraseña para entrar el sistema:</label>
            <input class="input" type="password" placeholder="Contraseña" name="contraseña" required autocomplete="off">
          </p>
          </div>
          <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
          <p class="texto-left">
          <input type="submit" name="" value="Registrar" class="btn">
        </form>
      </div>
    </div>
    <script>
    function logIn(account,password){
        $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'process/login.php',//aqui va tu direccion donde esta tu funcion php
            data: {cuenta:account,contrasena:password},//aqui tus datos
            success:function(data){
                $(".ResForm").html(data);
           },
           error:function(data){
            $(".ResForm").html("Ha ocurrido un error en el sistema");
           }
         });
    }
    function prueba(uno, dos){
      alert(uno + " "+ dos);
    }
    </script>
    <?php include './inc/footer.php'; ?>
  </body>
</html>
