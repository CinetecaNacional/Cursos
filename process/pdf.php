<?php
session_start();
error_reporting(E_PARSE);
$_SESSION['curso_id'] = $_POST['curso_id'];
echo "<script>
  window.open('http://localhost/cursos/process/pagoCursoPDF.php', '_blank');
</script>";
?>
