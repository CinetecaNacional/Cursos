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
    <div id="plecaTituloSeccion" class="tituloMedio color1">Agregar curso</div>
    <div class="wrapper">
      <div class="container">
        <div class="login">Datos del curso</div>
        <form action="process/createCourse.php" method="post" role="form" class="FormCatElec login-form" data-form="save">
          <div class="form-group">
          <p class="texto-left">
            Nombre:
            <input class="input" type="text" placeholder="Nombre" name="nombre" minlength="2" maxlength="60" required  oninput="upperCase(this)" title="El nombre debe contener al menos 2 letras">
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
          <label for="dynamic-label-input">Precio:</label>
          <input class="input" type="number" id="precio" placeholder="Precio" name="precio" min="0" step="0.01"  required   title="Ingrese solo números" onblur="pesos(this)">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Descripción:</label>
            <textarea name="descripcion" rows="7" cols="50"></textarea>
          </p>
          </div>
          <div class="form-group">
            <p class="texto-left">
              <label for="dynamic-label-input">Disponible:</label>
              <select id="input_available" name="disponible">
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
            </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Precio de promoción:</label>
            <input class="input" type="number" placeholder="Precio de promoción" name="promocion" min="0" step=".01"   title="Ingrese solo números" onblur="pesos(this); validarPromocion(this);">
          </p>
          </div>
          <div class="form-group">
          <p class="texto-left">
            <label for="dynamic-label-input">Promoción válida hasta:</label>
            <?php
            ini_set('date.timezone',"America/Mexico_City");
            $fecha = getdate();
            $hoy = $fecha['year']."-".$fecha['mon']."-".$fecha['mday'];
            echo '<input class="input" id="fecha_limite_promocion" type="date" name="fecha" value="" min="'.$hoy.'">';
            ?>
            </p>
          </div>
          <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
          <p class="texto-left">
          <input type="submit" name="" value="Registrar" class="btn">
          <a href="./index.php"><button type="button" name="button" class="btn" style="width:50%; margin-top:20px;">Cancelar</button></a>
        </form>
      </div>
    </div>
    <?php include './inc/footer.php'; ?>
  </body>
</html>
