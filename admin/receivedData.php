<!-- ARCHIVO QUE RECIBE TODOS LOS DATOS DE REGISTRO, HACE VALIDACIONES PARA EJECUTAR CIERTA FUNCIÓN -->

<?php
require "RegisterDB.php";
$query = new RegisterDB();
$table = $_POST['table'];
if($table === "checkInAdmin"){
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $validate = $query->validateAdmin();
    if($validate === 1){
        echo '<script language="javascript">alert("Ya hay un administrador");</script>';
    }else{
        $query -> checkInAdmin($nombre, $password);
    }
}
if($table === "login"){
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $login = $query->login($nombre,$password);
}
?>