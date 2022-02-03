<?php
require "Create.php";
$query = new Create();
$table = $_POST['table'];
if($table === "galeria"){
    $nom_foto = $_POST['nom_foto'];
    $archivo = $_FILES['archivo'];
    $descripcion = $_POST['descripcion'];

    $uploadFile = $query -> useHelper($archivo,"galeria");
    $route = $query -> getRoute($archivo,"galeria");
    $routeInsert = $route[1];

    if($uploadFile){
        $query -> createGalery($nom_foto, $routeInsert, $descripcion);
    }
}
?>