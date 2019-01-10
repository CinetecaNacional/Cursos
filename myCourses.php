<?php
    include './inc/sesion.php';
    include './library/configServer.php';
    include './library/consulSQL.php';
    setlocale(LC_TIME, 'spanish');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cursos en línea</title>
    <?php include './inc/link.php'; ?>
    <style media="screen">
      th, td{
        background: white;
        color: black;
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <?php include './inc/nav.php'; ?>
    <div id="plecaTituloSeccion" class="tituloMedio color2">Curso en proceso de inscripción</div>
    <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
    <?php
    if($_SESSION['usuario_id']){
      $usuario_id =$_SESSION['usuario_id'];
      $cursos=  ejecutarSQL::consultar("select * from cursos_usuarios where usuario_id = $usuario_id and pago = 0");
      $totalCursos= mysql_num_rows($cursos);
      if($totalCursos>0){
        echo '<table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Fecha limite de pago</th>
            <th>N° de referencia</th>
          </tr>
        </thead>';
        while($cate=mysql_fetch_array($cursos)){
          $curso_id = $cate['curso_id'];
          $nombreCurso=  ejecutarSQL::consultar("select * from cursos where cursos_id = $curso_id");
          if($nombreCurso>0){
            while($row=mysql_fetch_array($nombreCurso)){
              $nombre = $row['nombre'];
            }
        }
        $precio = $cate['precio'];
        $fecha_sin_formato = $cate['fecha_limite_pago'];
        $fecha = strtotime($fecha_sin_formato);
        $fecha = date ( 'j-m-Y' , $fecha);
        $referencia = $cate['numero_referencia'];
        echo '<tbody>
        <tr>
          <td>'.$nombre.'</td>
          <td style="width:100px;"> $ '.$precio.' Mx</td>
          <td>'.$fecha.'</td>
          <td>'.$referencia.'</td>
          <td style="width:190px;"><button type="button" name="button" class="btn" style="display:inline-block; width:190px;" onclick="pdf('.$curso_id.', '.$usuario_id.');">Detalles de pago</button></td>
          <td style="width:190px;"><button type="button" name="button" class="btn" style="display:inline-block; width:190px;" onclick="notificar('.$curso_id.', '.$usuario_id.');">Ya he realizado el pago</button></td>
        </tr></tbody>';
      }
    }else{
      echo "<p>No hay cursos</p>";
    }
    echo "</table>";
  }
    ?>
    <div id="plecaTituloSeccion" class="tituloMedio color1">Curso a los que estoy inscrito</div>
    <?php
    if($_SESSION['usuario_id']){
      $usuario_id =$_SESSION['usuario_id'];
      $cursos=  ejecutarSQL::consultar("select * from cursos_usuarios where usuario_id = $usuario_id and pago = 1");
      $totalCursos= mysql_num_rows($cursos);
      if($totalCursos>0){
        echo '<table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>link del curso</th>
            <th>Contraseña</th>
            <th>Usted tiene acceso al curso hasta</th>
          </tr>
        </thead>';
        while($cate=mysql_fetch_array($cursos)){
          $curso_id = $cate['curso_id'];
          $nombreCurso=  ejecutarSQL::consultar("select * from cursos where cursos_id = $curso_id");
          if($nombreCurso>0){
            while($row=mysql_fetch_array($nombreCurso)){
              $nombre = $row['nombre'];
              $contrasena = $cate['contraseña'];
              $link_curso = $cate['link_curso'];
              $fecha = $cate['vigencia_curso'];
              $vigencia_curso = strftime("%d de %B de %Y", strtotime($fecha));
            }
        }

        echo '<tbody>
        <tr>
          <td>'.$nombre.'</td>
          <td><a onclick="window.open(\''.$link_curso.'\',\'_blank\');" style="color:blue;"> '.$link_curso.'</a></td>
          <td>'.$contrasena.'</td>';
        if(!$vigencia_curso==""){
          echo '<td>'.$vigencia_curso.'</td>';
        }else{
          echo '<td>Acceso de por vida</td>';
        }
        echo '</tr></tbody>';
      }
    }else{
      echo "<p>No hay cursos</p>";
    }
    echo "</table>";
  }
    ?>
    <?php include './inc/footer.php'; ?>
    <script>
    function notificar(curso,usuario){
        $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'process/notificar.php',//aqui va tu direccion donde esta tu funcion php
            data: {curso_id:curso,usuario_id:usuario},//aqui tus datos
            success:function(data){
                $(".ResForm").html(data);
           },
           error:function(data){
            $(".ResForm").html("Ha ocurrido un error en el sistema");
           }
         });
    }
    function pdf(curso,usuario){
        $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'process/pdf.php',//aqui va tu direccion donde esta tu funcion php
            data: {curso_id:curso,usuario_id:usuario},//aqui tus datos
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
