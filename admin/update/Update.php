<!-- CLASE PARA MODIFICAR REGISTROS, ACCEDE A LA CLASE AUXILIAR Y TIENE MÉTODOS QUE USARÁN PARA MODIFICAR REGISTROS DE ACUERDO A LA TABLA -->
<?php
include "../../config/Connection.php"; // INCLUIR CONEXIÓN
include "../../helper/Helper.php"; // INCLUIR CLASE AUXILIAR
class Update{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    // DEVUELVE UN TRUE SI EL ARCHIVO SE LOGRÓ MOVER A LA RUTA, O SI NO FALSE.
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }
    // DEVUELVE LA RUTA PARA ALMACENAR Y MOVER EL ARCHIVO
    function getRoute($file,$route){
        return $this->helper->generateRoute($file,$route);
    }

    // BUSCAR REGISTRO POR ID PARA IMPRIMIR EN EL FORMULARIO
    function readGalery($id_foto){
        $sql = "SELECT * FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_foto);
        if($query->execute()){
            return $query;
        }
    }
    function readCategory($id_categoria){
        $sql = "SELECT categoria FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_categoria);
        if($query->execute()){
            return $query;
        }
    }
    function readNews($id_noticia){
        $sql = "SELECT * FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_noticia);
        if($query->execute()){
            return $query;
        }
    }
    function readCategoryForm(){
        $sql = "SELECT id_categoria, categoria FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readDocument($id_documento){
        $sql = "SELECT * FROM documento WHERE id_documento = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_documento);
        if($query->execute()){
            return $query;
        }
    }
    function readPrivacityForm(){
        $sql = "SELECT privacidad FROM documento";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readDirectory($id_directorio){
        $sql = "SELECT * FROM directorio WHERE id_directorio = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_directorio);
        if($query->execute()){
            return $query;
        }
    }
    // BUSCAR REGISTRO POR ID PARA IMPRIMIR EN EL FORMULARIO

    // RECIBE LOS NUEVOS DATOS PARA ACTUALIZARLOS
    function updateGalery($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto){
        $sql = "UPDATE galeria SET nom_foto = ?, archivo = ?, descripcion = ?, fecha_modi = ? WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto);
        $insert = $query -> execute($arrData);
        // LLAMA UNA FUNCIÓN AUXILIAR PARA MANDAR UN MENSAJE EXITOSO O ERRÓNEO.
        $this -> helper->validateInsert($insert,"La imagen $nom_foto se  ha modificado", "../main.php?p=galeria");
    }
    function updateCategory($categoria, $id_categoria){
        $sql = "UPDATE categoria SET categoria = ? WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($categoria, $id_categoria);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"La categoria se  ha modificado", "../main.php?p=categoria");
    }
    function updateNews($titulo,$texto,$descripcion,$categoria,$id_noticia){
        $sql = "UPDATE noticia SET titulo = ?,texto = ?,descripcion = ?, categoria = ? WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($titulo, $texto,$descripcion,$categoria,$id_noticia);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"La noticia se  ha modificado", "../main.php?p=noticias");
    }
    function updateDocuments($nombre,$descripcion,$archivo,$privacidad,$id_documento){
        $sql = "UPDATE documento SET nombre = ?,descripcion = ?,archivo = ?, privacidad = ? WHERE id_documento = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nombre, $descripcion,$archivo,$privacidad,$id_documento);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"El libro se  ha modificado", "../main.php?p=documentos");
    }
    function updateDirectory($nombre,$url,$estado,$carrera,$email,$telefono,$id_directorio){
        $sql = "UPDATE directorio SET nombre = ?,url = ?,estado = ?, carrera = ?,email = ?, telefono = ? WHERE id_directorio = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nombre, $url,$estado,$carrera,$email,$telefono,$id_directorio);
        $insert = $query -> execute($arrData);
        $this -> helper->validateInsert($insert,"El registro se  ha modificado", "../main.php?p=directorio");
    }
    // RECIBE LOS NUEVOS DATOS PARA ACTUALIZARLOS
}
?>