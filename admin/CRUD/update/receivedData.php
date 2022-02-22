<?php
// <!-- RECIBE TODOS LOS DATOS A ACTUALIZAR, DEPENDIENDO DE LA TABLA, LLAMA A UNA FUNCIÓN ESPECIFICA PARA HACER LA MODIFICACIÓN-->
include "Update.php";
$query = new Update();
$table = $_POST['table']; // SE GUARDA EL VALOR DE LA TABLA QUE SE RECIBE DESDE EL FORMULARIO.
switch ($table) {
    case 'galeria':
        $id_foto = $_POST['id_foto'];
        $nom_foto = $_POST['nom_foto'];
        $descripcion = $_POST['descripcion'];
        $fecha_modi = $_POST['fecha_modi'];
        $archivo = ( isset ($_FILES['archivo'] ) ? $_FILES['archivo'] : NULL);
        if ($archivo['size'] != 0 && $archivo['name'] != '') { 
            $uploadFile = $query -> useHelper($archivo,"imagenes"); // SE LLAMA A LA FUNCIÓN AUXILIAR PARA MOVER EL ARCHIVO.
            $route = $query -> getRoute($archivo,"imagenes"); // SE LLAMA A LA FUNCIÓN PARA OBTENER LA  RUTA PARA ALMACENAR EN LA BD.
            $routeInsert = $route[1]; // SE OBTINE LA RUTA
            if($uploadFile){
                $res = $query -> updateGalery($nom_foto, $routeInsert, $descripcion,$fecha_modi,$id_foto);
                echo $res;
            }
        }else { 
            $res = $query -> updateGaleryImg($nom_foto, $descripcion,$fecha_modi,$id_foto);
            echo $res;
        }
        break;
    case 'categoria':
        $id_categoria = $_POST['id_categoria'];
        $categoria = $_POST['categoria'];
        $res = $query -> updateCategory($categoria, $id_categoria);
        echo $res;
        break;
    case 'noticia':
        $id_noticia = $_POST['id_noticia'];
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $res = $query -> updateNews($titulo,$texto,$descripcion,$categoria,$id_noticia);
        echo $res;
        break;
    case 'imageNewsUp':
        $id_noticia = $_POST['id_noticia'];
        $foto = (isset($_POST['id_foto']) ? $_POST['id_foto'] : "");
        $images = $query->readTable("galeria","id_noticia",$id_noticia);
        $arrImgBD = []; $i = 1;
        foreach($images as $img){
            $arrImgBD[$i] = $img['id_foto'];
            $i++;
        }
        if($foto === ""){
            print_r ($images);
            foreach($arrImgBD as $img){
                $res = $query->updateImageNews($img);
                echo $res; 
            }
        }else{
            $getArr = $foto[0]; // Obtener imágenes actualmente seleccionadas, los trae en forma de cadena (primera posición arreglo)
            $array = explode ( ',', $getArr);
            $res = array_diff($arrImgBD,$array);
            if(count($res) === 0){
                echo "NoSelection";
            }
            foreach($res as $image){	
                $res = $query->updateImageNews($image);
                echo $res;
            };
        }
        break;
    case 'documento':
        $nombre = $_POST['nombre'];
        $id_documento = $_POST['id_documento'];
        $descripcion = $_POST['descripcion'];
        $privacidad = $_POST['privacidad'];
    
        $archivo = ( isset ($_FILES['archivo'] ) ? $_FILES['archivo'] : NULL);
        if ($archivo['size'] != 0 && $archivo['name'] != '') { 
            $uploadFile = $query -> useHelper($archivo,"documentos");
            $route = $query -> getRoute($archivo,"documentos");
            $routeInsert = $route[1];
            if($uploadFile){
                $res = $query -> updateDocuments($nombre,$descripcion, $routeInsert, $privacidad, $id_documento);
                echo $res;
            }
        }else { 
            $res = $query -> updateDocumentsDoc($nombre,$descripcion, $privacidad, $id_documento);
            echo $res;
        }
        break;
    case 'directorio':
        $id_directorio = $_POST['id_directorio'];
        $nombre = $_POST['nombre'];
        $url = $_POST['url'];
        $estado = $_POST['estado'];
        $carrera = $_POST['carrera'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
    
        $res = $query->updateDirectory($nombre,$url,$estado,$carrera,$email,$telefono,$id_directorio);
        echo $res;
        break;
    default:
        echo "Error al mandar datos, no coincide con ninguna acción para actualizar";
        break;
}
?>