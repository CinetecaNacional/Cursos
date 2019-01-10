<?php
session_start();
error_reporting(E_PARSE);
if($_SESSION['usuario_id']){
  echo '
  <div style="margin:2% 0%;" >
  <a href="process/logout.php" style="font-size:20px; margin-left: 85%; background:rgb(41, 41, 41);">
  <i class="fas fa-sign-out-alt" style="padding:2px 8px;">Cerrar sesión</i>
  </a>
  </div>';
}
?>
