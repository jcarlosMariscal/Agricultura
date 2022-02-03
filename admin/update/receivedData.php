<?php
require "Update.php";
$query = new Update();
$table = $_POST['table'];
if($table === "galeria"){
    $id_foto = $_POST['id_foto'];
    $nom_foto = $_POST['nom_foto'];
    $archivo = $_FILES['archivo'];
    $descripcion = $_POST['descripcion'];
    $fecha_modi = $_POST['fecha_modi'];

    $uploadFile = $query -> useHelper($archivo,"galeria");
    $route = $query -> getRoute($archivo,"galeria");
    $routeInsert = $route[1];

    if($uploadFile){
        $query -> updateGalery($nom_foto, $routeInsert, $descripcion,$fecha_modi,$id_foto);
    }
}
?>