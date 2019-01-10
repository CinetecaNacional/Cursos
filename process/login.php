<?php
    session_start();
    error_reporting(E_PARSE);
    include '../library/configServer.php';
    include '../library/consulSQL.php';
    $cuenta=$_POST['cuenta'];
    $contrasena=$_POST['contrasena'];
    if(!$cuenta==""&&!$contrasena==""){
        $usuario = ejecutarSQL::consultar("select * from usuarios where cuenta='$cuenta' and contraseña='$contrasena'");
        $numUsuario=mysql_num_rows($usuario);
        if($numUsuario>0){
        while($cate=mysql_fetch_array($usuario)){
        $_SESSION['nombre']=$cate['nombre'];
        $_SESSION['usuario_id']=$cate['usuario_id'];
        $_SESSION['cuenta']=$cate['cuenta'];
        $nombre=$_SESSION['nombre'];
        if($cate['privilegios']==0){
          $_SESSION['privilegios']='user';
        }else{
          $_SESSION['privilegios']='admin';
        }
        echo "<script>alert('Bienvenido $nombre');
        location.href='index.php';</script>";
      }
      }else{
        echo "<p style='color:red;'>Número de cuenta o contraseña incorrecta</p><script>alert('Número de cuenta o contraseña incorrecta');</script>";
      }
    }else{
        echo '<img src="assets/img/error.png"><br>Error campo vacío<br>Intente nuevamente';
    }
