<!-- ARCHIVO QUE RECIBE LOS ID PARA ELIMINAR, RECIBE LA TABLA DESDE EL FORMULARIO, SE HACE UNA CONDICIÓN Y DE ACUERDO A ESO SE LLAMA A LA FUNCIÓN PARA ELIMINAR EL REGISTRO. -->
<?php
require "Delete.php";
$query = new Delete();
$table = $_GET['table'];
if($table == "galeria"){
    $id_foto = $_GET['id_foto'];
    $query -> deleteGalery($id_foto); // MANDAR EL ID A ELIMINAR
}
?>