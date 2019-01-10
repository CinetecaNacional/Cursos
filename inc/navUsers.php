<?php session_start();
error_reporting(E_PARSE);?>
<nav>
    <ul>
        <li><a href="index.php" style="color:#fff;">Home</a></li><?php
        if($_SESSION['usuario_id']){
          echo "<li><a href='info.php' style='color:#fff;'>Mis datos</a></li>
          <li><a href='myCourses.php' style='color:#fff;'>Mis cursos</a>";
        if($_SESSION['privilegios']=='admin'){
            echo "<ul>
            <li><a href='createCourse.php' style='color:#fff;'>Agregar nuevo</a></li>
            </ul>
            ";
          }
          echo "</li>";
          if($_SESSION['privilegios']=='admin'){
            echo "<li><a href='userNotification.php' style='color:#fff;'>Usuarios</a></li>";
          }
          echo "<li style='background:gray; position: absolute; right: 0;'><a href='process/logout.php' style='color:#fff;'>Cerrar sesión</a>";
        }?>
        <?php
        if(!$_SESSION['usuario_id']){
          echo "<li style='background:gray; position: absolute; right: 0;'><a href='logIn.php' style='color:#fff;'>Iniciar sesión</a>";
        }
          ?>
    </ul>
</nav>
