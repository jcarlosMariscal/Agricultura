<!-- ESTA CLASE INCLUYE EL ARCHIVO DE CONEXIÓN Y LA CLASE CON FUNCIONES AUXILIARES. ESTE ARCHIVO LEE LA BASE DE DATOS CON FUNCIONES PARA MOSTRAR LOS REGISTROS EN CADA SECCIÓN  -->
<?php
include "admin/config/Connection.php";
include "admin/helper/Helper.php";
class Inicio{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }

    function createArr($id_select,$table){ return $this -> helper->createArr($id_select,$table,$id=NULL,$this->cnx); }
    // SECCIÓN INICIO - Obtener noticias destacadas
    function readNewsDestacados($id){
        $sql = "SELECT * FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }
    // SECCIÓN INICIO - Obtener un máximo de tres imágenes de las noticias destacadas
    function getImage($id_noticia){
        $sql = "SELECT * FROM galeria WHERE id_noticia = ? ORDER BY id_foto DESC LIMIT 3";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()){
            if($query->rowCount() === 0) return false;
            return $query;
        }
    }
    // SECCIÓN INICIO - Obtener todas las noticias, excepto las destacadas
    function readMoreNews($id1,$id2){
        $sql = "SELECT * FROM noticia WHERE id_noticia != ? AND id_noticia != ? ORDER BY id_noticia DESC LIMIT 4";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id1);
        $query->bindParam(2,$id2);
        if($query->execute()) return $query; 
    }
    // SECCIÓN INICIO - Obtener una imágen por cada noticia
    function getImageOne($id_noticia){
        $sql = "SELECT * FROM galeria WHERE id_noticia = ? ORDER BY id_foto DESC LIMIT 1";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()){
            if($query->rowCount() === 0) return false;
            return $query;
        }
    }
    // function cleanUrl($string){
    //     $res = preg_replace('/[\@\.\,\;\"\']+/', '', $string);
    //     $cadena = str_replace(" ", "-", $res);
    //     $resultado = strtolower($cadena);
    //     return $resultado;
    // }

}