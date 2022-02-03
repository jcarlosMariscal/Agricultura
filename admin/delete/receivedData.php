<?php
require "Delete.php";
$query = new Delete();
$table = $_GET['table'];
if($table == "galeria"){
    $id_foto = $_GET['id_foto'];
    $query -> deleteGalery($id_foto);
}
?>