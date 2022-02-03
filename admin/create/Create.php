<?php
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Create{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }
    function getRoute($file,$route){
        return $this->helper->generateRoute($file,$route);
    }

    function createGalery($nom_foto,$archivo,$descripcion){
        $sql = "INSERT INTO galeria(nom_foto, archivo, descripcion) VALUES (?,?,?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nom_foto,$archivo,$descripcion);
        $insert = $query -> execute($arrData);

        $this -> helper->validateInsert($insert,"La imagen se ha agregado", "../main.php?p=galeria");
    }
}