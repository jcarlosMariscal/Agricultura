<?php
// <!-- CLASE CON MÉTODOS PARA CREAR REGISTROS -->
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Create{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    //  ------------------OBTENER FUNCIONES AUXILIARES ------------------
    function useHelper($file,$route) {return $this -> helper->uploadFile($file,$route); }
    function getRoute($file,$route){ return $this->helper->generateRoute($file,$route); }
    function readCategory(){ return $this->helper->readCategory($this->cnx); }
    function readTitleNews($id_noticia){ return $this->helper->readTitleNews($id_noticia,$this->cnx); }

    //  ------------------INSERTAR IMAGEN A GALERIA ------------------
    function createGalery($nom_foto,$archivo,$descripcion){
        try {
            $sql = "INSERT INTO galeria(nom_foto, archivo, descripcion) VALUES (?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nom_foto,$archivo,$descripcion);
            $insert = $query -> execute($arrData);
            return "successGal";
        } catch (PDOException $th) {
            return "errorGal";
        }
    }
    //  ------------------INSERTAR CATEGORIA ------------------
    function createCategory($categoria){
        try {
            $sql = "INSERT INTO categoria(categoria) VALUES (?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($categoria);
            $insert = $query -> execute($arrData);
            return "successCat";
        } catch (PDOException $th) {
            return "errorCat";
        }
    }

    //  ------------------INSERTAR NOTICIA ------------------
    function createNews($titulo,$texto,$descripcion,$categoria){
        try {
            $sql = "INSERT INTO noticia(titulo, texto, descripcion, categoria) VALUES (?,?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($titulo,$texto,$descripcion,$categoria);
            $insert = $query -> execute($arrData);
            $id = $this->cnx->lastInsertId();
            return "successNews".$id;
        }catch (PDOException $th) {
            return "errorNews";
        }
    }

    //  ------------------INSERTAR DOCUMENTO ------------------
    function createDocuments($nombre,$descripcion,$archivo,$privacidad){
        try {
            $sql = "INSERT INTO documento(nombre, descripcion, archivo, privacidad) VALUES (?,?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre,$descripcion,$archivo,$privacidad);
            $insert = $query -> execute($arrData);
            return "successDoc";
        }catch (PDOException $th) {
            return "errorDoc";
        }
    }

    //  ------------------INSERTAR EN EL DIRECTORIO ------------------
    function createDirectory($nombre,$url,$estado,$carrera,$email,$telefono){
        try {
            $sql = "INSERT INTO directorio(nombre, url, estado, carrera,email,telefono) VALUES (?,?,?,?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre,$url,$estado,$carrera,$email,$telefono);
            $insert = $query -> execute($arrData);
            return "successDir";
        } catch (PDOException $th) {
            return "errorDir";
        }
    }


    //  ------------------SELECCIONAR IMAGEN PARA LA NOTICIA ------------------
    function readImages(){
        $sql = "SELECT id_foto,nom_foto,archivo FROM galeria WHERE id_noticia IS NULL";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
        // ---------- RELACIONAR NOTICIA A UNA IMAGEN -------------------------
    function insertImagesNews($id_foto,$id_noticia){
        try {
            $sql = "UPDATE galeria SET id_noticia = ? WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $query->bindParam(1,$id_noticia);
            $query->bindParam(2,$id_foto);
            $insert = $query->execute();
            return "successImageNews";
        }  catch (PDOException $th) {
            return "insertError";
        }
    }
}