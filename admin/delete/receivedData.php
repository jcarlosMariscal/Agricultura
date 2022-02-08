<!-- ARCHIVO QUE RECIBE LOS ID PARA ELIMINAR, RECIBE LA TABLA DESDE EL FORMULARIO, SE HACE UNA CONDICIÓN Y DE ACUERDO A ESO SE LLAMA A LA FUNCIÓN PARA ELIMINAR EL REGISTRO. -->
<?php
require "Delete.php";
$query = new Delete();
$table = $_GET['table'];
if($table == "galeria"){
    $id_foto = $_GET['id_foto'];
    $query -> deleteGalery($id_foto); // MANDAR EL ID A ELIMINAR
}
if($table === "categoria"){
    $id_categoria = $_GET['id_categoria'];
    $query -> deleteCategory($id_categoria);
}
if($table === "noticia"){
    $id_noticia = $_GET['id_noticia'];
    $query -> deleteNews($id_noticia);
}
if($table === "documento"){
    $id_documento = $_GET['id_documento'];
    $query -> deleteDocument($id_documento);
}
if($table === "directorio"){
    $id_directorio = $_GET['id_directorio'];
    $query -> deleteDirectory($id_directorio);
}
?>