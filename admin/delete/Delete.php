<!-- CLASE CON FUNCIONES PARA ELIMINAR REGISTROS -->
<?php
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Delete{
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

    function deleteGalery($id_foto){
        $sql = "DELETE FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_foto);
        $insert = $query -> execute();

        $this -> helper->validateInsert($insert,"La imagen se ha eliminado", "../main.php?p=galeria");
    }
}

