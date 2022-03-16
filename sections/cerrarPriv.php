<?php
// <!-- ARCHIVO QUE CIERRA LA SESIÓN DEL ADMINISTRADOR -->
session_start();
unset($_SESSION["privado"]);
header("Location: ../documentos");
?>