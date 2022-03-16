<?php
// <!-- ARCHIVO QUE RECIBE TODOS LOS DATOS A REGISTRAR DESDE EL FORMULARIO, ADEMÁS DE LA TABLA EN ESPECIFICO, HACE LA CONDICIÓN Y A PARTIR DE ESO LLAMA A UNA FUNCIÓN PARA HACER EL REGISTRO CORRECTO -->
require "Create.php";
require "../../helper/regex.php";
$query = new Create();
$regex = new Regex();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
switch ($table) {
    case 'galeria':
        $extensiones =  array("png","PNG","jpeg","jpg");
        if(!empty($_POST)){
            $nom_foto = (isset($_POST['nom_foto']) ? $_POST['nom_foto'] : NULL);
            $descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL);
            $archivo = (isset($_FILES['archivo']) ? $_FILES['archivo'] : NULL);
            if(empty($nom_foto) || empty($descripcion) || $archivo['size'] === 0 || $archivo['name'] == NULL){
                echo "errForm";
                return;
            }
            $arch = $archivo['name'];
            $extension = pathinfo($arch, PATHINFO_EXTENSION);
            if(!in_array($extension,$extensiones)){
                echo "Error: El formato seleccionado no está permitido";
                return;
            }
            $regexFoto = $regex->validateField('nombre',$nom_foto);
            $regexDesc = $regex->validateField('descripcion',$descripcion);
            if($regexFoto && $regexDesc){
                $repeatNom = $query->repeated($table,"nom_foto",$nom_foto);
                $repeatDesc = $query->repeated($table,"descripcion",$descripcion);
                if($repeatNom || $repeatDesc){
                    echo "rExits";
                    return;
                }
                $uploadFile = $query -> useHelper($archivo,"imagenes");
                $route = $query -> getRoute($archivo,"imagenes");
                $routeInsert = $route[1];
                if($uploadFile){
                    $res = $query -> createGalery($nom_foto, $routeInsert,$descripcion);
                    echo $res;
                }
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            } 
        }
        break;
    case 'categoria':
        if(!empty($_POST)){
            $categoria = (isset($_POST['categoria']) ? $_POST['categoria'] : NULL);
            if(empty($categoria)){
                echo "errForm";
                return;
            }
            $regexCat = $regex->validateField('nombre100',$categoria);
            if($regexCat){
                $repeat = $query->repeated($table,"categoria",$categoria);
                if($repeat){
                    echo "rExits";
                    return;
                }
                $res = $query -> createCategory($categoria);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'noticia':
        if(!empty($_POST)){
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
                $repeatTit = $query->repeated($table,"titulo",$titulo);
                $repeatDesc = $query->repeated($table,"descripcion",$descripcion);
                $repeatTxt = $query->repeated($table,"texto",$texto);
                if($repeatTit || $repeatDesc || $repeatTxt){
                    echo "rExits";
                    return;
                }
                $res = $query->createNews($titulo,$texto,$descripcion,$categoria);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'imageNews':
        $id_noticia = (isset($_POST['id_noticia']) ? $_POST['id_noticia'] : NULL);
        if(isset($_POST['id_foto'])){
            $id_foto = $_POST['id_foto'];
            $getArr = $id_foto[0];
            $array = explode ( ',', $getArr);
            foreach($array as $image){	
                $res = $query->insertImagesNews($image,$id_noticia);
                echo $res;
            };
        }
        break;
    case 'documento':
        $extensiones =  array("pdf");
        if(!empty($_POST)){
            $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : NULL);
            $descripcion = (isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL);
            $archivo = (isset($_FILES['archivo']) ? $_FILES['archivo'] : NULL);
            $privacidad = (isset($_POST['privacidad']) ? $_POST['privacidad'] : NULL);

            if($privacidad != 1 && $privacidad != 2){ // Validar si el select viene con los valores correctos de privacidad
                echo "errSelect";
                return;
            }
            if(empty($nombre) || empty($descripcion) || $archivo['size'] === 0 || $archivo['name'] == NULL){
                echo "errForm";
                return;
            }
            $arch = $archivo['name'];
            $extension = pathinfo($arch, PATHINFO_EXTENSION);
            if(!in_array($extension,$extensiones)){
                echo "Error: El formato seleccionado no está permitido";
                return;
            }
            $regexNom = $regex->validateField('nombre',$nombre);
            $regexDesc = $regex->validateField('descripcion',$descripcion);
            if($regexNom && $regexDesc){
                $repeatNom = $query->repeated($table,"nombre",$nombre);
                $repeatDesc = $query->repeated($table,"descripcion",$descripcion);
                if($repeatNom || $repeatDesc){
                    echo "rExits";
                    return;
                }
                $uploadFile = $query -> useHelper($archivo,"documentos");
                $route = $query -> getRoute($archivo,"documentos");
                $routeInsert = $route[1];
            
                if($uploadFile){
                    $res = $query -> createDocuments($nombre,$descripcion, $routeInsert, $privacidad);
                    echo $res;
                }
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'directorio':
        if(!empty($_POST)){
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
                $repeatNom = $query->repeated($table,"nombre",$nombre);
                $repeatUrl = $query->repeated($table,"url",$url);
                $repeatEmail = $query->repeated($table,"email",$email);
                $repeatTel = $query->repeated($table,"telefono",$telefono);
                if($repeatNom || $repeatUrl || $repeatEmail || $repeatTel){
                    echo "rExits";
                    return;
                }
                $res = $query->createDirectory($nombre,$url,$estado,$carrera,$email,$telefono);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'docsPriv':
        if(!empty($_POST)){
            $password = (isset($_POST['password']) ? $_POST['password'] : NULL);
            if(empty($password)){
                echo "errForm";
                return;
            }
            $regexPass = $regex->validateField('password',$password); // $regexText = $regex->validateField('nombre100',$texto);
            if($regexPass){
                $res = $query->createPassword($password);
                echo $res;
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    case 'docsLogin':
        if(!empty($_POST)){
            $password = (isset($_POST['password']) ? $_POST['password'] : NULL);
            if(empty($password)){
                echo "errForm";
                return;
            }
            $regexPass = $regex->validateField('password',$password); // $regexText = $regex->validateField('nombre100',$texto);
            if($regexPass){
                $res = $query->toAccess($password);
                if($res){
                    echo "successPriv";
                }else{
                    echo "errorPriv";
                }
            }else{
                echo "Error: Por favor rellena el formulario correctamente";
            }
        }
        break;
    default:
    header("Location: ../../main.php");
        break;
}
