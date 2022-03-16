<?php
// <!-- LEER REGISTROS DE LA BD PARA MOSTRAR EN LA PÁGINA WEB, EXCEPTO LA SECCIÓN DE INICIO, ESA PARTE TIENE UN ARCHIVO INDEPENDIENTE (Inicio.php)  -->
include "../admin/config/Connection.php";
include "../admin/helper/Helper.php";
class Read{
    public $cnx,$helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }

    function paginador($id,$tabla,$recibido,$rango,$privacidad=NULL) {
        return $this -> helper->paginador($id,$tabla,$recibido,$rango,$privacidad,$this->cnx); 
    }
    function readDirectory() { return $this -> helper->readDirectory($this->cnx); }
    function readCategoryId($id){ return $this -> helper->readCategoryIdNew($id,$this->cnx); }
    function createArr($id_select,$table){ return $this -> helper->createArr($id_select,$table,$id=NULL,$this->cnx); }
    function getImageArrId($id){
        $id_select ="id_foto"; $table = "galeNoti";
        return $this -> helper->createArr($id_select,$table,$id,$this->cnx);
    }
    // SECCIÓN GALERIA - Usar el paginador para limitar el número de imágenes que se muestran
    function readGalery($recibido,$rango){
        $paginador = $this->paginador("id_foto","galeria",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM galeria ORDER BY id_foto DESC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    // SECCIÓN DOCUMENTOS - Usar el paginador para limitar el número de de documentos, condicionar para mostrar de acuerdo a la privacidad
    function readDocuments($recibido,$rango,$privacidad){
        $paginador = $this->paginador("id_documento","documento",$recibido,$rango,$privacidad);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM documento WHERE privacidad = ? ORDER BY id_documento DESC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$privacidad);
        if($query->execute()) return $query;
    }
    // SECCIÓN NOTICIAS - NOTICIAS DESTACADOS - Mostrar las dos noticias destacadas
    function readNewsDestacados($id){
        $sql = "SELECT * FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }

    // SECCIÓN NOTICIAS - TODAS LAS NOTICIAS - Mostrar todas las noticias, excepto las destacadas
    function readMoreNews($id1,$id2,$recibido,$rango){
        $paginador = $this->paginador("id_noticia","noticia",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM noticia WHERE id_noticia != ? AND id_noticia != ? ORDER BY id_noticia DESC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id1);
        $query->bindParam(2,$id2);
        if($query->execute()) return $query;
    }

    //  IMAGEN PARA UNA NOTICIA - OBTENER UNA IMAGEN - Traer una de las imagenes seleccionadas de la noticia
    function getImageOne($id_noticia){
        $sql = "SELECT * FROM galeria WHERE id_noticia = ? ORDER BY id_foto DESC LIMIT 1";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()){
            if($query->rowCount() === 0) return false;
            return $query;
        }
    }

    // SECCIÓN NOTICIA - MOSTRAR NOTICIA - Obtener una noticia para mostrar su información
    function readNewsId($id){
        $sql = "SELECT * FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }
    // SECCIÓN NOTICIA - OBTENER IMAGEN ALEATORIO - Obtener una una imagen aleatorio de la noticia
    function readImgId($id){
        $sql = "SELECT * FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }
    // SECCIÓN NOTICIA - OBTENER MÁS IMÁGENES SELECCIONADAS - Obtener todas las imágenes seleccionadas, excepto la principal
    function readMoreImgId($id_foto,$id_noticia){
        $sql = "SELECT * FROM galeria WHERE id_foto != ? AND id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_foto);
        $query->bindParam(2,$id_noticia);
        if($query->execute()) return $query;
    }
    // SECCIÓN NOTICIA - OBTENER MÁS NOTICIAS - Obtener 5 noticias con la misma categoria
    function readMoNews($id,$noti){
        $sql = "SELECT * FROM noticia WHERE categoria = ? AND id_noticia != ? ORDER BY id_noticia DESC LIMIT 5";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        $query->bindParam(2,$noti);
        if($query->execute()) return $query;
    }
}