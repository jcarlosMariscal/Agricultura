<?php
// <!-- ARCHIVO QUE CIERRA LA SESIÓN DEL ADMINISTRADOR -->
session_start();
if($_SESSION['admin']){
    session_destroy();
    header("Location: documentos");
}
?>