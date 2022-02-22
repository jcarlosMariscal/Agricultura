<?php
// <!-- ARCHIVO QUE CIERRA LA SESIÓN DEL ADMINISTRADOR -->
session_start();
session_destroy();
header("location: index.php");
?>