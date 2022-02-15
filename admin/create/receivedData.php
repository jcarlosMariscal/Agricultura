<?php
// <!-- ARCHIVO QUE RECIBE TODOS LOS DATOS A REGISTRAR DESDE EL FORMULARIO, ADEMÁS DE LA TABLA EN ESPECIFICO, HACE LA CONDICIÓN Y A PARTIR DE ESO LLAMA A UNA FUNCIÓN PARA HACER EL REGISTRO CORRECTO -->
require "Create.php";
$query = new Create();
$table = $_POST['table'];
if($table === "galeria"){
    $nom_foto = $_POST['nom_foto'];
    $archivo = $_FILES['archivo'];
    $descripcion = $_POST['descripcion'];

    $uploadFile = $query -> useHelper($archivo,"imagenes");
    $route = $query -> getRoute($archivo,"imagenes");
    $routeInsert = $route[1];

    if($uploadFile){
        $query -> createGalery($nom_foto, $routeInsert,$descripcion);
        
    }
}
if($table === "categoria"){
    $categoria = $_POST['categoria'];
    $query -> createCategory($categoria);
}
if($table === "noticia"){
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];

    $query->createNews($titulo,$texto,$descripcion,$categoria);
}
if($table === "imageNews"){
    $id_noticia = $_POST['id_noticia'];
    if(isset($_POST['id_foto'])){
        $id_foto = $_POST['id_foto'];
        $getArr = $id_foto[0];
        $array = explode ( ',', $getArr);
        foreach($array as $image){	
            $query->insertImagesNews($image,$id_noticia);
        };
    }
}
if($table === "documento"){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $archivo = $_FILES['archivo'];
    $privacidad = $_POST['privacidad'];

    $uploadFile = $query -> useHelper($archivo,"documentos");
    $route = $query -> getRoute($archivo,"documentos");
    $routeInsert = $route[1];

    if($uploadFile){
        $query -> createDocuments($nombre,$descripcion, $routeInsert, $privacidad);
    }
}
if($table === "directorio"){
    $nombre = $_POST['nombre'];
    $url = $_POST['url'];
    $estado = $_POST['estado'];
    $carrera = $_POST['carrera'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $query->createDirectory($nombre,$url,$estado,$carrera,$email,$telefono);
}
?>