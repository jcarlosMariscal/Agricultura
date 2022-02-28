<!-- CLASE CON FUNCIONES PARA LEER REGISTROS PARA EL ADMINISTRADOR -->
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/Read.php"){
    header("Location: ../../main.php");
}
include "config/Connection.php";
class Read{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
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
    // OBTENER CATEGORIA DE UNA NOTICIA
    function readCategoryID($id_categoria){
        $sql = "SELECT categoria FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_categoria);
        if($query->execute()){
            return $query;
        }
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
        $sql = "SELECT archivo FROM galeria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_noticia);
        if($query->execute()){
            return $query;
        }
    }

}