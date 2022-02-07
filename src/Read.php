<!-- ESTA CLASE INCLUYE EL ARCHIVO DE CONEXIÓN Y LA CLASE CON FUNCIONES AUXILIARES. ESTE ARCHIVO LEE LA BASE DE DATOS CON FUNCIONES PARA MOSTRAR LOS REGISTROS EN CADA SECCIÓN  -->
<?php
include "config/Connection.php";
include "helper/Helper.php";
class Read{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }

    function readGalery(){
        $sql = "SELECT * FROM galeria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
}