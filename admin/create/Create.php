<!-- CLASE CON MÉTODOS PARA CREAR REGISTROS -->
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
    //  ------------------OBTENER FUNCIONES AUXILIARES ------------------
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }
    function getRoute($file,$route){
        return $this->helper->generateRoute($file,$route);
    }
    //  ------------------OBTENER FUNCIONES AUXILIARES ------------------

    //  ------------------INSERTAR IMAGEN A GALERIA ------------------
    function createGalery($nom_foto,$archivo,$descripcion){
        $sql = "INSERT INTO galeria(nom_foto, archivo, descripcion) VALUES (?,?,?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nom_foto,$archivo,$descripcion);
        $insert = $query -> execute($arrData);

        $this -> helper->validateInsert($insert,"La imagen se ha agregado", "../main.php?p=galeria");
    }
    //  ------------------INSERTAR IMAGEN A GALERIA ------------------

    //  ------------------INSERTAR CATEGORIA ------------------
    function createCategory($categoria){
        $sql = "INSERT INTO categoria(categoria) VALUES (?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($categoria);
        $insert = $query -> execute($arrData);

        $this -> helper->validateInsert($insert,"La categoria se ha agregado", "../main.php?p=categoria");
    }
    //  ------------------ INSERTAR CATEGORIA ------------------

    //  ------------------INSERTAR NOTICIA ------------------
    function createNews($titulo,$texto,$descripcion,$categoria){
        $sql = "INSERT INTO noticia(titulo, texto, descripcion, categoria) VALUES (?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($titulo,$texto,$descripcion,$categoria);
        $insert = $query -> execute($arrData);
        
        $this -> helper->validateInsert($insert,"La noticia se ha agregado, por favor seleccione una imagen de la galeria para la noticia", "../main.php?p=noticias");
    }

    //  ------------------INSERTAR NOTICIA ------------------

    //  ------------------INSERTAR LIBRO ------------------
    function createDocuments($nombre,$descripcion,$archivo,$privacidad){
        $sql = "INSERT INTO documento(nombre, descripcion, archivo, privacidad) VALUES (?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nombre,$descripcion,$archivo,$privacidad);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"El documento se ha agregado", "../main.php?p=documentos");
    }
    //  ------------------INSERTAR LIBRO ------------------

    //  ------------------INSERTAR EN EL DIRECTORIO ------------------
    function createDirectory($nombre,$url,$estado,$carrera,$email,$telefono){
        $sql = "INSERT INTO directorio(nombre, url, estado, carrera,email,telefono) VALUES (?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nombre,$url,$estado,$carrera,$email,$telefono);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"El registro se ha agregado", "../main.php?p=directorio");
    }
    //  ------------------INSERTAR EN EL DIRECTORIO ------------------




    //  ------------------SELECCIONAR IMAGEN PARA LA NOTICIA ------------------
    function readImages(){
        $sql = "SELECT id_foto,nom_foto,archivo FROM galeria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function insertImagesNews($id_foto,$id_noticia){
        $sql = "UPDATE galeria SET id_noticia = ? WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_noticia);
        $query->bindParam(2,$id_foto);
        $insert = $query->execute();

        $this -> helper->validateInsert($insert,"Se ha agregado imagen a la noticia", "../main.php?p=noticias");
    }
    //  ------------------SELECCIONAR IMAGEN PARA LA NOTICIA ------------------

    //  ------------------OBTENER CATEGORIA PARA MOSTRAR EN INPUT SELECT ------------------
    function readCategory(){
        $sql = "SELECT id_categoria, categoria FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    //  ------------------OBTENER CATEGORIA PARA MOSTRAR EN INPUT SELECT ------------------

    //  ------------------OBTENER TITULO DE NOTICIA ------------------
    function readTitleNews($id_noticia){
        $sql = "SELECT titulo FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1, $id_noticia);
        if($query->execute()){
            return $query;
        }
    }
    // ------------------OBTENER TITULO DE NOTICIA ------------------
}