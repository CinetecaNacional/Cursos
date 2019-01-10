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
    <div id="plecaTituloSeccion" class="tituloMedio color1">Personas que han realizado notificado su pago</div>
    <div class='ResForm' style='width: 100%; text-align: center; margin: 0;'></div>
    <?php
    if($_SESSION['usuario_id']){
      $cursos=  ejecutarSQL::consultar("select * from cursos_usuarios where status=1 and pago = 0");
      $totalCursos= mysql_num_rows($cursos);
      if($totalCursos>0){
        echo '<table>
        <thead>
          <tr>
          <th>Referencia</referencia>
            <th>Curso</th>
            <th>Nombre de la persona</th>
            <th>link del curso</th>
            <th>Contraseña</th>
          </tr>
        </thead>';
        while($cate=mysql_fetch_array($cursos)){
          $curso_id = $cate['curso_id'];
          $usuario_id =$cate['usuario_id'];
          $nombreCurso=  ejecutarSQL::consultar("select * from cursos where cursos_id = $curso_id");
          if($nombreCurso>0){
            while($row=mysql_fetch_array($nombreCurso)){
              $nombre = $row['nombre'];
            }
        }
        $Persona=  ejecutarSQL::consultar("select * from usuarios where usuario_id = $usuario_id");
        if($Persona>0){
          while($row=mysql_fetch_array($Persona)){
            $nombrePersona = $row['nombre'].' '.$row['apellido_paterno'].' '. $row['apellido_materno'];
            $contrasena = $row['contraseña'];
          }
      }

        $referencia = $cate['numero_referencia'];
        $link_curso = $cate['link_curso'];
        $vigencia_curso = $cate['vigencia_curso'];
        echo '<tbody>
        <tr>
        <td>'.$referencia.'</td>
          <td>'.$nombre.'</td>
          <td>'.$nombrePersona.'</td>
          <td><input type="text" name="link" id="link_curso" value="https://cursosenlinea.cinetecanacional.net" size="40"></td>
          <td><input type="text" name="password" value="'.$contrasena.'" disabled></td>
          <td style="width:140px;"><button type="button" name="button" class="btn" style="display:inline-block; width:140px;" onclick="credenciales('.$curso_id.', '.$usuario_id.', \''.$contrasena.'\');">Guardar</button></td>';
      }
    }else{
      echo "<p>No hay cursos</p>";
    }
    echo "</table>";
  }
    ?>
    <?php include './inc/footer.php'; ?>
    <script>
    function credenciales(curso,usuario,password){
      var link = document.getElementById('link_curso').value;
      if(link){
        if(link){
          $.ajax({
              type:'POST', //aqui puede ser igual get
              url: 'process/credencialesCurso.php',//aqui va tu direccion donde esta tu funcion php
              data: {curso_id:curso,usuario_id:usuario,contrasena:password, link_curso:link},//aqui tus datos
              success:function(data){
                  $(".ResForm").html(data);
             },
             error:function(data){
              $(".ResForm").html("Ha ocurrido un error en el sistema");
             }
           });
        }
      }else{
        alert("Ingrese un link");
      }
    }
</script>
  </body>
</html>
