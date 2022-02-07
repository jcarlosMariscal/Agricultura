<!-- RECIBE TODOS LOS DATOS A ACTUALIZAR, DEPENDIENDO DE LA TABLA, LLAMA A UNA FUNCIÓN ESPECIFICA DE LA CLASE PARA HACER LA MODIFICACIÓN-->
<?php
require "Update.php";
$query = new Update();
$table = $_POST['table']; // SE GUARDA EL VALOR DE LA TABLA QUE SE RECIBE DESDE EL FORMULARIO.
if($table === "galeria"){ 
    $id_foto = $_POST['id_foto'];
    $nom_foto = $_POST['nom_foto'];
    $archivo = $_FILES['archivo'];
    $descripcion = $_POST['descripcion'];
    $fecha_modi = $_POST['fecha_modi'];

    $uploadFile = $query -> useHelper($archivo,"galeria"); // SE LLAMA A LA FUNCIÓN AUXILIAR PARA MOVER EL ARCHIVO.
    $route = $query -> getRoute($archivo,"galeria"); // SE LLAMA A LA FUNCIÓN PARA OBTENER LA  RUTA PARA ALMACENAR EN LA BD.
    $routeInsert = $route[1]; // SE OBTINE LA RUTA

    if($uploadFile){
        $query -> updateGalery($nom_foto, $routeInsert, $descripcion,$fecha_modi,$id_foto); // SE LLAMA A LA FUNCIÓN PARA MODIFICAR LOS DATOS
    }
}
?>