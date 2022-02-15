<?php
// <!-- ARCHIVO QUE RECIBE TODOS LOS DATOS DE REGISTRO, HACE VALIDACIONES PARA EJECUTAR CIERTA FUNCIÓN -->
require "RegisterDB.php";
$query = new RegisterDB();
$table = $_POST['table'];
if($table === "checkInAdmin"){
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $validate = $query->validateAdmin();
    if($validate === 1){
        echo 'exists';
    }else{
        $query -> checkInAdmin($nombre, $password);
    }
}
if($table === "login"){
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $login = $query->login($nombre,$password);
    if($login){
        echo "success";
    }else{
        echo "loginError";
    }
}
?>