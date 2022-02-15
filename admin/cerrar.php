<!-- ARCHIVO QUE CIERRA LA SESIÓN DEL ADMINISTRADOR -->

<?php
session_start();
session_destroy();
header("location: ../admin.php");
?>
<?php
?>