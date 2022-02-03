<?php
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Update{
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

    function readGalery($id_foto){
        $sql = "SELECT * FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_foto);
        if($query->execute()){
            return $query;
        }
    }
    function updateGalery($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto){
        $sql = "UPDATE galeria SET nom_foto = ?, archivo = ?, descripcion = ?, fecha_modi = ? WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"La imagen $nom_foto se  ha modificado", "../main.php?p=galeria");
    }
}
?>