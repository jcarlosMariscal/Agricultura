<?php
// <!-- ARCHIVO QUE RECIBE LOS ID PARA ELIMINAR, RECIBE LA TABLA DESDE EL FORMULARIO, SE HACE UNA CONDICIÓN Y DE ACUERDO A ESO SE LLAMA A LA FUNCIÓN PARA ELIMINAR EL REGISTRO. -->
require "Delete.php";
$query = new Delete();
$table = $_POST['table'];
$id = $_POST['id'];
switch ($table) {
    case 'galeria':
        $validate = $query->validate($table,$id);
        if($validate){
            echo "occupied";
        }else{
            $res = $query -> deleteGalery($id);
            echo $res;
        }
        break;
    case 'categoria':
        $validate = $query->validate($table,$id);
        if($validate){
            echo "occupied";
        }else{
            $res = $query -> deleteCategory($id);
            echo $res;
        }
        break;
    case 'noticia':
        $res = $query -> deleteNews($id);
        echo $res;
        break;
    case 'documento':
        $res = $query -> deleteDocument($id);
        echo $res;
        break;
    case 'directorio':
        $res = $query -> deleteDirectory($id);
        echo $res;
        break;
    default:
        echo "Error al eliminar, no coicidencia";
        break;
}