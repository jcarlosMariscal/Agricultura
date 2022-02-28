<?php
// <!-- ARCHIVO QUE RECIBE TODOS LOS DATOS DE REGISTRO, HACE VALIDACIONES PARA EJECUTAR CIERTA FUNCIÓN -->
require "RegisterDB.php";
$query = new RegisterDB();
$table = (isset($_POST['table']) ? $_POST['table'] : NULL);
switch ($table) {
    case 'checkInAdmin':
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $validate = $query->validateAdmin();
        if($validate === 1){
            echo 'exists';
        }else{
            $query -> checkInAdmin($nombre, $password);
        }
        break;
    case 'login':
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $login = $query->login($nombre,$password);
        if($login){
            echo "success";
            // header("Location: main.php");
        }else{
            echo "loginError";
        }
        break;
    default:
        header("Location: index.php");
        break;
}
?>