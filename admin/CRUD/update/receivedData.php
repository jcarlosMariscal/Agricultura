<?php
// <!-- RECIBE TODOS LOS DATOS A ACTUALIZAR, DEPENDIENDO DE LA TABLA, LLAMA A UNA FUNCIÓN ESPECIFICA PARA HACER LA MODIFICACIÓN-->
include "Update.php";
require "../../helper/regex.php";
$query = new Update();
$regex = new Regex();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
switch ($table) {
    case 'galeria':
        $extensiones =  array("png","PNG","jpeg","jpg");
        if(!empty($_POST)){
            $id_foto = (isset($_POST['id_foto']) ? $_POST['id_foto'] : NULL);
            $nom_foto = (isset($_POST['nom_foto']) ? $_POST['nom_foto'] : NULL);
            $descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL);
            $fecha_modi = strftime( "%Y-%m-%d %H-%M-%S");
            $archivo = (isset($_FILES['archivo']) ? $_FILES['archivo'] : NULL);
            if(empty($nom_foto) || empty($descripcion)){
                echo "errForm";
                return;
            }
            $regexFoto = $regex->validateField('nombre',$nom_foto);
            $regexDesc = $regex->validateField('descripcion',$descripcion);
            if($regexFoto && $regexDesc){
                $repeatNom = $query->repeated($table,"nom_foto","id_foto",$nom_foto,$id_foto);
                $repeatDesc = $query->repeated($table,"descripcion","id_foto",$descripcion,$id_foto);
                if($repeatNom || $repeatDesc){
                    echo "rExits";
                    return;
                }
                if ($archivo['size'] != 0 && $archivo['name'] != '') { 
                    $arch = $archivo['name'];
                    $extension = pathinfo($arch, PATHINFO_EXTENSION);
                    if(!in_array($extension,$extensiones)){
                        echo "Error: El formato seleccionado no está permitido";
                        return;
                    }
                    $uploadFile = $query -> useHelper($archivo,"imagenes");
                    $route = $query -> getRoute($archivo,"imagenes");
                    $routeInsert = $route[1];
                    if($uploadFile){
                        $res = $query -> updateGalery($nom_foto, $routeInsert, $descripcion,$fecha_modi,$id_foto);
                        echo $res;
                    }
                }else{
                    $res = $query -> updateGaleryImg($nom_foto, $descripcion,$fecha_modi,$id_foto);
                    echo $res;
                }
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'categoria':
        if(!empty($_POST)){
            $id_categoria = (isset($_POST['id_categoria']) ? $_POST['id_categoria'] : NULL);
            $categoria = (isset($_POST['categoria']) ? $_POST['categoria'] : NULL);
            if(empty($categoria)){
                echo "errForm";
                return;
            }
            $regexCat = $regex->validateField('nombre100',$categoria);
            if($regexCat){
                $repeat = $query->repeated($table,"categoria","id_categoria",$categoria,$id_categoria);
                if($repeat){
                    echo "rExits";
                    return;
                }
                $res = $query -> updateCategory($categoria, $id_categoria);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'noticia':
        if(!empty($_POST)){
            $id_noticia = (isset($_POST['id_noticia']) ? $_POST['id_noticia'] : NULL);
            $titulo = (isset($_POST['titulo']) ? $_POST['titulo'] : NULL);
            $texto = (isset($_POST['texto']) ? $_POST['texto'] : NULL);
            $descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL);
            $categoria = (isset($_POST['categoria']) ? $_POST['categoria'] : NULL);

            $cat = $query->readCategory();
            $arrCat =[];
            foreach($cat as $c){
                array_push($arrCat,$c['id_categoria']);
            }
            if(!in_array($categoria, $arrCat)){
                echo "errSelect";
                return;
            }
            if(empty($titulo) || empty($descripcion)){
                echo "errForm";
                return;
            }
            $regexTit = $regex->validateField('nombre100',$titulo); // $regexText = $regex->validateField('nombre100',$texto);
            $regexDes = $regex->validateField('descripcion',$descripcion);
            if($regexTit && $regexDes){
                $repeatTit = $query->repeated($table,"titulo","id_noticia",$titulo,$id_noticia);
                $repeatDesc = $query->repeated($table,"descripcion","id_noticia",$descripcion,$id_noticia);
                $repeatTxt = $query->repeated($table,"texto","id_noticia",$texto,$id_noticia);
                if($repeatTit || $repeatDesc || $repeatTxt){
                    echo "rExits";
                    return;
                }
                $res = $query -> updateNews($titulo,$texto,$descripcion,$categoria,$id_noticia);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'imageNewsUp':
        $id_noticia = (isset($_POST['id_noticia']) ? $_POST['id_noticia'] : NULL);
        $foto = (isset($_POST['id_foto']) ? $_POST['id_foto'] : NULL);
        $images = $query->readTable("galeria","id_noticia",$id_noticia);
        $arrImgBD = []; $i = 1;
        foreach($images as $img){
            $arrImgBD[$i] = $img['id_foto'];
            $i++;
        }
        if($foto === ""){
            // print_r ($images);
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
        $extensiones =  array("pdf");
        if(!empty($_POST)){
            $id_documento = (isset($_POST['id_documento']) ? $_POST['id_documento'] : NULL);
            $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
            $descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL);
            $archivo = (isset($_FILES['archivo']) ? $_FILES['archivo'] : NULL);
            $privacidad = (isset($_POST['privacidad']) ? $_POST['privacidad'] : NULL);

            if($privacidad != 1 && $privacidad != 2){ // Validar si el select viene con los valores correctos de privacidad
                echo "errSelect";
                return;
            }
            if(empty($nombre) || empty($descripcion)){
                echo "errForm";
                return;
            }
            $regexNom = $regex->validateField('nombre',$nombre);
            $regexDesc = $regex->validateField('descripcion',$descripcion);
            if($regexNom && $regexDesc){
                $repeatTit = $query->repeated($table,"nombre","id_documento",$nombre,$id_documento);
                $repeatDesc = $query->repeated($table,"descripcion","id_documento",$descripcion,$id_documento);
                if($repeatTit || $repeatDesc){
                    echo "rExits";
                    return;
                }
                if ($archivo['size'] != 0 && $archivo['name'] != '') { 
                    $arch = $archivo['name'];
                    $extension = pathinfo($arch, PATHINFO_EXTENSION);
                    if(!in_array($extension,$extensiones)){
                        echo "Error: El formato seleccionado no está permitido";
                        return;
                    }
                    $uploadFile = $query -> useHelper($archivo,"documentos");
                    $route = $query -> getRoute($archivo,"documentos");
                    $routeInsert = $route[1];
                    if($uploadFile){
                        $res = $query -> updateDocuments($nombre,$descripcion, $routeInsert, $privacidad, $id_documento);
                        echo $res;
                    }
                }else{
                    $res = $query -> updateDocumentsDoc($nombre,$descripcion, $privacidad, $id_documento);
                    echo $res;
                }
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'directorio':
        if(!empty($_POST)){
            $id_directorio = (isset($_POST['id_directorio']) ? $_POST['id_directorio'] : NULL);
            $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
            $url = (isset($_POST['url']) ? $_POST['url'] : NULL);
            $estado = (isset($_POST['estado']) ? $_POST['estado'] : NULL);
            $carrera = (isset($_POST['carrera']) ? $_POST['carrera'] : NULL);
            $email = (isset($_POST['email']) ? $_POST['email'] : NULL);
            $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : NULL);
            if(empty($nombre) || empty($url) || empty($estado) || empty($carrera) || empty($email) || empty($telefono)){
                echo "errForm";
                return;
            }
            $regexNom = $regex->validateField('nombre100',$nombre); // $regexText = $regex->validateField('nombre100',$texto);
            $regexUrl = $regex->validateField('url',$url);
            $regexEst = $regex->validateField('nombre100',$estado);
            $regexCarr = $regex->validateField('nombre100',$carrera);
            $regexEmail = $regex->validateField('email',$email);
            $regexTel = $regex->validateField('telefono',$telefono);
            if($regexNom && $regexUrl && $regexEst && $regexCarr && $regexEmail && $regexTel){
                $repeatNom = $query->repeated($table,"nombre","id_directorio",$nombre,$id_directorio);
                $repeatUrl = $query->repeated($table,"url","id_directorio",$url,$id_directorio);
                $repeatEmail = $query->repeated($table,"email","id_directorio",$email,$id_directorio);
                $repeatTel = $query->repeated($table,"telefono","id_directorio",$telefono,$id_directorio);
                if($repeatNom || $repeatUrl || $repeatEmail || $repeatTel){
                    echo "rExits";
                    return;
                }
                $res = $query->updateDirectory($nombre,$url,$estado,$carrera,$email,$telefono,$id_directorio);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    default:
        header("Location: ../../main.php");
        break;
}
?>