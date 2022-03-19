<!-- CLASE CON FUNCIONES PARA LEER REGISTROS PARA EL ADMINISTRADOR -->
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/Read.php"){
    header("Location: ../../main.php");
}
include "config/Connection.php";
include "helper/Helper.php";
class Read{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }

    function paginador($id,$tabla,$recibido,$rango,$privacidad=NULL) {
        return $this -> helper->paginador($id,$tabla,$recibido,$rango,$privacidad,$this->cnx); 
    }

    function readGalery($recibido,$rango){
        $paginador = $this->paginador("id_foto","galeria",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM galeria ORDER BY id_foto ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    function readDocuments($recibido,$rango){
        $paginador = $this->paginador("id_documento","documento",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM documento ORDER BY id_documento ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    function readNews($recibido,$rango){
        $paginador = $this->paginador("id_noticia","noticia",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM noticia ORDER BY id_noticia ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    function readCategory($recibido=NULL,$rango=NULL){
        if($recibido == NULL && $rango == NULL) {
            $sql = "SELECT * FROM categoria";
        }else{
            $paginador = $this->paginador("id_categoria","categoria",$recibido,$rango);
            $inicio = $paginador[0];
            $cantidad_pagina = $paginador[1];
            $sql = "SELECT * FROM categoria ORDER BY id_categoria ASC LIMIT $inicio,$cantidad_pagina";
        }
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    function readDirectory($recibido,$rango){
        $paginador = $this->paginador("id_directorio","directorio",$recibido,$rango);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM directorio ORDER BY id_directorio ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()) return $query;
    }
    // OBTENER CATEGORIA DE UNA NOTICIA
    function readCategoryID($id_categoria){
        $sql = "SELECT categoria FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_categoria);
        if($query->execute()) return $query;
    }
    // VALIDAR SI LA NOTICIA TIENE IMAGEN, DEVOLVER CUANTAS SON
    function searchImageNews($id_noticia){
        $sql = "SELECT * FROM galeria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()){
            $validate = $query->rowCount();
            return $validate;
        }
    }
    // OBTENER LAS IMÁGENES QUE TIENE LA NOTICIA
    function getImage($id_noticia){
        $sql = "SELECT archivo,id_foto FROM galeria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()) return $query;
    }
    // ---------- VERIFICAR SI YA EXISTE UNA CONTRASEÑA PARA DOCUMENTOS PRIVADOS --------------------
    function verificatePassword(){
        $sql = "SELECT * FROM acceso_doc";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            if($query->rowCount() == 1) return true;
            return false;
        }
    }

}