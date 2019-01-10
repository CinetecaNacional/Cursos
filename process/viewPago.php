<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
error_reporting(E_PARSE);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Pago del curso en linea</title>
    <style media="screen">
    *{
      margin: 0px;
      padding: 0px;
    }
    .cabecera{
      width: 85%;
      margin: auto;
    }
    .cabecera img {
      float: right;
    }
    .cabecera h1{
      color: rgb(204, 98, 31);
    }
    .cuerpo{
      margin-top: 20px;
      width: 85%;
      margin: auto;
    }
    .cuerpo p{
      text-align: justify;
      font-size: 20px;
      margin-bottom: 10px;
    }
    .importante{
      font-size: 22px;
      color: rgb(26, 35, 73);
      width: auto;
      display: block;
      font-weight: bold;
    }
    .referencia{
      font-size: 22px;
      color: rgb(26, 35, 73);
      font-weight: bold;
    }
    .tabla{
      width: 100%;
      margin: 10px 0px;
      font-size:20px;
      border: 1px solid black;
    }
    .footer{
      position: absolute;
      bottom: 0px;
      width: 100%;
      height: 20%;
    }
    </style>
  </head>
  <body>
  <?php
  setlocale(LC_TIME, 'spanish');
  $usuario_id=$_SESSION['usuario_id'];
  $curso_id=$_SESSION['curso_id'];
  $usuarios=  ejecutarSQL::consultar("select * from usuarios where usuario_id=$usuario_id");
  while($usuario=mysql_fetch_array($usuarios)){
  $nombreCompleto =$usuario['nombre']." ". $usuario['apellido_paterno']." ".$usuario['apellido_materno'];
  $cuenta=$usuario['cuenta'];
  }
  $cursos =  ejecutarSQL::consultar("select * from cursos_usuarios where usuario_id='".$usuario_id."' && curso_id='".$curso_id."'");
  $cursoInscrito =  ejecutarSQL::consultar("select * from cursos where cursos_id='".$curso_id."'");
  while($curso=mysql_fetch_array($cursoInscrito)){
    $nombre_curso= $curso['nombre'];
  }
  while($curso=mysql_fetch_array($cursos)){
    $fecha = strtotime ($curso['fecha_limite_pago']);
    $fecha_limite_pago= strftime("%d de %B de %Y", $fecha);
    //$fecha_limite_pago= date("j", $fecha).'-'.date("m", $fecha).'-'.date("Y", $fecha);
    $referencia = $curso['numero_referencia'];
    $monto =number_format($curso['precio'],2,".",",");
  }
  if($usuarios){
    echo '<div class="cabecera">
      <img src="https://www.cinetecanacional.net/imagenes/encabezado/CulturaCineteca.png" alt="CINETECA NACIONAL">
      <h1>Orden de pago</h1>
    </div>
    <div class="cuerpo">
      <p>Estimado <label class="importante"> '.$nombreCompleto.'</label>: Usted se ha pre-registrado con éxito al curso <label class="importante">'.$nombre_curso.'</label></p>
      <p>Su número de cuenta y usuario es: <label class="importante">'.$cuenta.'</label></p>
      <p>El monto a pagar es <label class="importante">$'.$monto.'</label>  antes del <label class="importante">'.$fecha_limite_pago.'</label>.</p>
      <p>Su número de referencia es: <label class="importante">'.$referencia.'</label>.</p>
      <p>Puede usted realizar el pago directo en sucursal, en un cajero automático HSBC o un cajero depositador, a través de su Banca Personal por Internet (BPI), HSBCnet o bien pago interbancario  (SPEI).
        Por favor conserve el comprobante de pago.</p>

        <div class="tabla">
          <p>Datos para pago en el banco HSBC</p>
          <p>Nombre del cliente: <label class="importante">BANOBRAS, S.N.C. FIDEICOMISO PARA LA CINETECA NACIONAL  </label></p>
          <p>Linea de captura <label class="referencia">'.$referencia.'</label></p>
          <p>Clave RAP: <label class="importante">1937</label></p>
        </div>
        <div class="tabla">
          <p>Datos para pago por transferencia interbancaria</p>
          <p>Nombre del cliente: <label class="importante">BANOBRAS, S.N.C. FIDEICOMISO PARA LA CINETECA NACIONAL  </label></p>
          <p>Clabe interbancaria: <label class="referencia">021180550300019373</label></p>
          <p>Concepto del pago: <label class="importante">'.$referencia.'</label></p>
          <p>Clave RAP: <label class="importante">1937</label></p>
        </div>

      <p>Nosotros le enviaremos un correo electrónico para concluir su registro y brindarle su contraseña de acceso a la plataforma y al curso elegido.</p>
    </div>
    <img src="../assets/img/footer.png" alt="Datos de la CINETECA NACIONAL" class="footer">';
  }
  ?>
  </body>
</html>
