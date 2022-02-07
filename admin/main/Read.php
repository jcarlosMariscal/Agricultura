<!-- CLASE CON FUNCIONES PARA LEER REGISTROS PARA EL ADMINISTRADOR -->
<?php
include "../config/Connection.php";
include "../helper/Helper.php";
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
    function readDocuments(){
        $sql = "SELECT * FROM documento";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readNews(){
        $sql = "SELECT * FROM noticia";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readCategory(){
        $sql = "SELECT * FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readDirectory(){
        $sql = "SELECT * FROM directorio";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
}