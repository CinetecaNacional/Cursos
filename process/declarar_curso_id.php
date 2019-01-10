<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
include 'generarReferencia.php';
session_start();
error_reporting(E_PARSE);
$_SESSION['curso_id'] = $_POST['curso_id'];
  echo "<script>
  $(location).attr('href','updateCurso.php');
  </script>";
?>
