<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cursos en línea</title>
    <?php include './inc/sesion.php'; ?>
    <?php include './inc/link.php'; ?>
    <style>
    .texto-left{
      text-align: left;
      font-size:17px;
      font-family: 'Roboto', sans-serif;
    }
    </style>
  </head>
  <body>
    <?php include './inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Actualizar curso</div>
    <?php
    $id=$_SESSION['curso_id'];
    $curso=ejecutarSQL::consultar("select * from cursos where cursos_id=$id");
    while($datos_curso=mysql_fetch_array($curso)){
      $nombre =$datos_curso['nombre'];
      $precio =$datos_curso['precio'];
      $descripcion =$datos_curso['descripcion'];
      $disponible =$datos_curso['disponible'];
      $promocion =$datos_curso['promocion'];
      $fecha_limite_promocion =$datos_curso['fecha_limite_promocion'];
      $promocion_disponible =$datos_curso['promocion_disponible'];
    }
    ini_set('date.timezone',"America/Mexico_City");
    $fecha = getdate();
    $hoy = $fecha['year']."-".$fecha['mon']."-".$fecha['mday'];
    ?>
    <?php
    echo '
    <div class="wrapper">
      <div class="container">
        <div class="login">Datos del curso</div>
        <form action="process/updateCursos.php" method="post" role="form" class="FormCatElec login-form" data-form="save">
          <div class="form-group">
          <p class="texto-left">
            Nombre:
            <input class="input" type="text" placeholder="Nombre" name="nombre" minlength="2" maxlength="60" required  oninput="upperCase(this)" title="El nombre debe contener al menos 2 letras" value="'.$nombre.'">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
          <label for="dynamic-label-input">Precio:</label>
          <input class="input" type="number" id="precio" placeholder="Precio" name="precio" min="0" step="0.01"  required   title="Ingrese solo números" onblur="pesos(this)" value="'.$precio.'">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Descripción:</label>
            <input class="input" type="text" placeholder="Descripción" name="descripcion" maxlength="100"  oninput="upperCase(this)" value="'.$descripcion.'">
          </p>
          </div>
          <div class="form-group">
            <p class="texto-left">
              <label for="dynamic-label-input">Disponible:</label>
              <select id="input_available" name="disponible" value="'.$disponible.'">
              <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Precio de promoción:</label>
            <input class="input" type="number" placeholder="Precio de promoción" name="promocion" min="0" step=".01"   title="Ingrese solo números" onblur="pesos(this); validarPromocion(this);" value="'.$promocion.'">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Promoción válida hasta:</label>
            <input class="input" id="fecha_limite_promocion" type="date" name="fecha" value="'.$fecha_limite_promocion.'" min="'.$hoy.'">
            </p>
          </div>
          <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
          <p class="texto-left">
          <input type="submit" name="" value="Registrar" class="btn">
          <a href="./index.php"><button type="button" name="button" class="btn" style="width:50%; margin-top:20px;">Cancelar</button></a>
        </form>
      </div>
    </div>
    ';
    ?>
    <?php include './inc/footer.php'; ?>
  </body>
</html>
