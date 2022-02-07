<!-- ARCHIVO QUE RECIBE TODOS LOS DATOS A REGISTRAR DESDE EL FORMULARIO, ADEMÁS DE LA TABLA EN ESPECIFICO, HACE LA CONDICIÓN Y A PARTIR DE ESO LLAMA A UNA FUNCIÓN PARA HACER EL REGISTRO CORRECTO -->
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