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
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }
    function getRoute($file,$route){
        return $this->helper->generateRoute($file,$route);
    }

    //  ------------------INSERTAR IMAGEN A GALERIA ------------------
    function createGalery($nom_foto,$archivo,$descripcion){
        try {
            $sql = "INSERT INTO galeria(nom_foto, archivo, descripcion) VALUES (?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nom_foto,$archivo,$descripcion);
            $insert = $query -> execute($arrData);
            echo "successGal";
        } catch (PDOException $th) {
            echo "errorGal";
        }
    }

    //  ------------------INSERTAR CATEGORIA ------------------
    function createCategory($categoria){
        try {
            $sql = "INSERT INTO categoria(categoria) VALUES (?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($categoria);
            $insert = $query -> execute($arrData);
            echo "successCat";
        } catch (PDOException $th) {
            echo "errorCat";
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
            echo "successNews".$id;
        }catch (PDOException $th) {
            echo "errorNews";
        }
    }

    //  ------------------INSERTAR DOCUMENTO ------------------
    function createDocuments($nombre,$descripcion,$archivo,$privacidad){
        try {
            $sql = "INSERT INTO documento(nombre, descripcion, archivo, privacidad) VALUES (?,?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre,$descripcion,$archivo,$privacidad);
            $insert = $query -> execute($arrData);
            echo "successDoc";
        }catch (PDOException $th) {
            echo "errorDoc";
        }
    }

    //  ------------------INSERTAR EN EL DIRECTORIO ------------------
    function createDirectory($nombre,$url,$estado,$carrera,$email,$telefono){
        try {
            $sql = "INSERT INTO directorio(nombre, url, estado, carrera,email,telefono) VALUES (?,?,?,?,?,?)";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre,$url,$estado,$carrera,$email,$telefono);
            $insert = $query -> execute($arrData);
            echo "successDir";
        } catch (PDOException $th) {
            echo "errorDir";
        }
    }


    //  ------------------SELECCIONAR IMAGEN PARA LA NOTICIA ------------------
    function readImages(){
        $sql = "SELECT id_foto,nom_foto,archivo FROM galeria WHERE id_noticia IS NULL";
        $query = $this->cnx->prepare($sql);
        // $query->bindParam(1,NULL);
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
            echo "successImageNews";
        }  catch (PDOException $th) {
            echo "insertError";
        }
    }

    //  ------------------OBTENER CATEGORIA PARA MOSTRAR EN INPUT SELECT ------------------
    function readCategory(){
        $sql = "SELECT id_categoria, categoria FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    //  ------------------OBTENER TITULO DE NOTICIA ------------------
    function readTitleNews($id_noticia){
        $sql = "SELECT titulo FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_noticia);
        if($query->execute()){
            return $query;
        }
    }
}