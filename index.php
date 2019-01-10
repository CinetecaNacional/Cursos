<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
    include './process/validarPromociones.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <?php include 'inc/sesion.php'; ?>
    <?php include 'inc/link.php'; ?>
    <title>Cursos en línea</title>
  </head>
  <body>
    <?php include 'inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Curso en línea</div>
    <div class="wrapper">
      <h2>Ofertados acualmente</h2>
      <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
      <!-- ==================== Lista cursos=============== -->
      <?php
      setlocale(LC_TIME, 'spanish');
      $cursos=  ejecutarSQL::consultar("select * from cursos");
      if($cursos>0){
        while($cate=mysql_fetch_array($cursos)){
          if($cate['disponible']==true){
            $curso_id = $cate['cursos_id'];
            $nombre = $cate['nombre'];
            $descripcion = $cate['descripcion'];
            $precio = number_format($cate['precio'],2,".",",");
            $promocion = number_format( $cate['promocion'],2,".",",");
            $fecha = $cate['fecha_limite_promocion'];
            $fechaFormato = strftime("%d de %B de %Y", strtotime($fecha));
            $promocion_disponible = $cate['promocion_disponible'];
            if($promocion_disponible==1){
              echo "<details>
              <summary>$nombre</summary>
              <p>$descripcion</p>
              <p>Precio normal:$ $precio Mx</p>
              <p>Precio de promoción: $ $promocion Mx disponible hasta el $fechaFormato</p>
              <button type='submit' name='button' class='btn' style='width:45%; margin:auto;' onclick='accion($curso_id);'> Inscribir </button>";
              if($_SESSION['privilegios']=='admin'){
                echo "<button type='button' name='button' class='btn' style=' width:45%; margin:auto;' onclick='actualizar($curso_id);'> Actualizar </button>";
              }
              echo "</details>";
            }else{
              echo "<details>
              <summary>$nombre</summary>
              <p>$descripcion</p>
              <p>Precio: $ $precio Mx</p>
              <button type='button' name='button' class='btn' style=' width:45%; margin:auto;' onclick='accion($curso_id);'> Inscribir </button>";
              if($_SESSION['privilegios']=='admin'){
                echo "<button type='button' name='button' class='btn' style=' width:45%; margin:auto;' onclick='actualizar($curso_id);'> Actualizar </button>";
              }
              echo "</details>";
            }
          }
        }
      }else{
        echo "<details>
        <summary>Actualmente no se esta ofertando ningun curso</summary>
        </details>";
      }
      ?>
      <!-- ==================== Fin lista cursos =============== -->
    </div>
    <?php include './inc/footer.php'; ?>
    <script>
    function accion(curso){
        $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'process/inscripcionCurso.php',//aqui va tu direccion donde esta tu funcion php
            data: {id:1,curso_id:curso},//aqui tus datos
            success:function(data){
                $(".ResForm").html(data);
           },
           error:function(data){
            $(".ResForm").html("Ha ocurrido un error en el sistema");
           }
         });
    }
    function actualizar(curso){
      $.ajax({
          type:'POST', //aqui puede ser igual get
          url: 'process/declarar_curso_id.php',//aqui va tu direccion donde esta tu funcion php
          data: {id:1,curso_id:curso},//aqui tus datos
          success:function(data){
              $(".ResForm").html(data);
         },
         error:function(data){
          $(".ResForm").html("Ha ocurrido un error en el sistema");
         }
       });
    }
</script>
  </body>
</html>
