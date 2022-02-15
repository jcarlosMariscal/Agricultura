<?php
// <!-- RECIBE TODOS LOS DATOS A ACTUALIZAR, DEPENDIENDO DE LA TABLA, LLAMA A UNA FUNCIÓN ESPECIFICA DE LA CLASE PARA HACER LA MODIFICACIÓN-->
include "Update.php";
$query = new Update();
$table = $_POST['table']; // SE GUARDA EL VALOR DE LA TABLA QUE SE RECIBE DESDE EL FORMULARIO.
if($table === "galeria"){ 
    $id_foto = $_POST['id_foto'];
    $nom_foto = $_POST['nom_foto'];
    $archivo = $_FILES['archivo'];
    $descripcion = $_POST['descripcion'];
    $fecha_modi = $_POST['fecha_modi'];

    $uploadFile = $query -> useHelper($archivo,"imagenes"); // SE LLAMA A LA FUNCIÓN AUXILIAR PARA MOVER EL ARCHIVO.
    $route = $query -> getRoute($archivo,"imagenes"); // SE LLAMA A LA FUNCIÓN PARA OBTENER LA  RUTA PARA ALMACENAR EN LA BD.
    $routeInsert = $route[1]; // SE OBTINE LA RUTA

    if($uploadFile){
        $query -> updateGalery($nom_foto, $routeInsert, $descripcion,$fecha_modi,$id_foto); // SE LLAMA A LA FUNCIÓN PARA MODIFICAR LOS DATOS
    }
}

if($table === "categoria"){
    $id_categoria = $_POST['id_categoria'];
    $categoria = $_POST['categoria'];
    $query -> updateCategory($categoria, $id_categoria);
}

if($table ==="noticia"){
    $id_noticia = $_POST['id_noticia'];
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $query -> updateNews($titulo,$texto,$descripcion,$categoria,$id_noticia);
}
if($table === "imageNews"){
    $id_noticia = $_POST['id_noticia'];
    if(isset($_POST['id_foto'])){
        $id_foto = $_POST['id_foto'];
        $getArr = $id_foto[0];
        $array = explode ( ',', $getArr);
        
        $images = $query->readImages($id_noticia);
        $imgBD = [];
        if($images){
            $i = 1;
            foreach($images as $data){
                $imgBD[$i] = $data['id_foto'];
                $i++;
            }
        }
        $res = array_diff($imgBD,$array);
        // print_r($res);
        if(count($res) === 0){
            echo "NoSelection";
        }
        foreach($res as $image){	
            $query->deleteImageNews($image);
        };
    }
}

if($table === "documento"){
    $nombre = $_POST['nombre'];
    $id_documento = $_POST['id_documento'];
    $descripcion = $_POST['descripcion'];
    $archivo = $_FILES['archivo'];
    $privacidad = $_POST['privacidad'];

    $uploadFile = $query -> useHelper($archivo,"documentos");
    $route = $query -> getRoute($archivo,"documentos");
    $routeInsert = $route[1];

    if($uploadFile){
        $query -> updateDocuments($nombre,$descripcion, $routeInsert, $privacidad, $id_documento);
    }
}
if($table === "directorio"){
    $id_directorio = $_POST['id_directorio'];
    $nombre = $_POST['nombre'];
    $url = $_POST['url'];
    $estado = $_POST['estado'];
    $carrera = $_POST['carrera'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $query->updateDirectory($nombre,$url,$estado,$carrera,$email,$telefono,$id_directorio);
}
?>