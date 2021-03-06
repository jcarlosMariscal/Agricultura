<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/update/Update.php"){
    header("Location: ../../main.php");
}
// <!-- CLASE PARA MODIFICAR REGISTROS, ACCEDE A LA CLASE AUXILIAR Y TIENE MÉTODOS QUE USARÁN PARA MODIFICAR REGISTROS DE ACUERDO A LA TABLA -->
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Update{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    // DEVUELVE UN TRUE SI EL ARCHIVO SE LOGRÓ MOVER A LA RUTA, O SI NO FALSE.
    function useHelper($file,$route){ return $this -> helper->uploadFile($file,$route); }
    // DEVUELVE LA RUTA PARA ALMACENAR Y MOVER EL ARCHIVO
    function getRoute($file,$route){ return $this->helper->generateRoute($file,$route); }
    function readTitleNews($id_noticia){ return $this->helper->readTitleNews($id_noticia,$this->cnx); }
    function readCategory(){ return $this->helper->readCategory($this->cnx); }
    function readCategoryID($id){ return $this->helper->readCategoryID($this->cnx,$id); }
    function readPrivacityForm($id){ return $this->helper->readPrivacityForm($this->cnx,$id); }
    function idUpdate($table,$field,$id){ return $this->helper->idUpdate($this->cnx,$table,$field,$id); }

        // ------------ VALIDAR SI UN REGISTRO YA EXISTE ANTES DE AGREGAR O ACTUALIZAR
    function repeated($table,$field,$fieldID,$value,$valueID){
        $sql = "SELECT $field FROM $table WHERE $field = ? AND $fieldID != ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$value);
        $query->bindParam(2,$valueID);
        $query->execute();
        if($query->rowCount() === 0) return false;
        return true;
    }

    // BUSCAR UN REGISTRO PARA MOSTRAR EN FORMULARIO,RECIBE LA TABLA A CONSULTAR, EL CAMPO (id_foto,...) A VALIDAR Y SU VALOR
    function readTable($table,$field,$id){
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }

    // RECIBE LOS NUEVOS DATOS PARA ACTUALIZARLOS
    function updateGalery($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto){
        try {
            $sql = "UPDATE galeria SET nom_foto = ?, archivo = ?, descripcion = ?, fecha_modi = ? WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto);
            $insert = $query -> execute($arrData);
            return "successGal";
        } catch (PDOException $th) {
            return "errorGal";
        }
    }
    function updateGaleryImg($nom_foto,$descripcion,$fecha_modi,$id_foto){
        try {
            $sql = "UPDATE galeria SET nom_foto = ?, descripcion = ?, fecha_modi = ? WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nom_foto,$descripcion,$fecha_modi,$id_foto);
            $insert = $query -> execute($arrData);
            return "successGal";
        } catch (PDOException $th) {
            return "errorGal";
        }
    }
    function updateCategory($categoria, $id_categoria){
        try {
            $sql = "UPDATE categoria SET categoria = ? WHERE id_categoria = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($categoria, $id_categoria);
            $insert = $query -> execute($arrData);
            return "successCat";
        } catch (PDOException $th) {
            return "errorCat";
        }
    }
    function updateNews($titulo,$texto,$descripcion,$categoria,$id_noticia){
        try {
            $sql = "UPDATE noticia SET titulo = ?,texto = ?,descripcion = ?, categoria = ? WHERE id_noticia = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($titulo, $texto,$descripcion,$categoria,$id_noticia);
            $insert = $query -> execute($arrData);
            return "successNewsUp";
        } catch (PDOException $th) {
            return "errorNews";
        }
    }
    function updateDocuments($nombre,$descripcion,$archivo,$privacidad,$id_documento){
        try {
            $sql = "UPDATE documento SET nombre = ?,descripcion = ?,archivo = ?, privacidad = ? WHERE id_documento = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre, $descripcion,$archivo,$privacidad,$id_documento);
            $insert = $query -> execute($arrData);
            return "successDoc";
        } catch (PDOException $th) {
            return "errorDoc";
        }
    }
    function updateDocumentsDoc($nombre,$descripcion,$privacidad,$id_documento){
        try {
            $sql = "UPDATE documento SET nombre = ?,descripcion = ?, privacidad = ? WHERE id_documento = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre, $descripcion,$privacidad,$id_documento);
            $insert = $query -> execute($arrData);
            return "successDoc";
        } catch (PDOException $th) {
            return "errorDoc";
        }
    }
    function updateDirectory($nombre,$url,$estado,$carrera,$email,$telefono,$id_directorio){
        try {
            $sql = "UPDATE directorio SET nombre = ?,url = ?,estado = ?, carrera = ?,email = ?, telefono = ? WHERE id_directorio = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array($nombre, $url,$estado,$carrera,$email,$telefono,$id_directorio);
            $insert = $query -> execute($arrData);
            return "successDir";
        } catch (PDOException $th) {
            return "errorDir";
        }
    }
    function updateImageNews($id_foto){
        try {
            $sql = "UPDATE galeria SET id_noticia = ? WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array(NULL, $id_foto);
            $delete = $query -> execute($arrData);
            return "successImageNews";
        } catch (PDOException $th) {
            return "errorImageNews";
        }
    }
    // ------------ CAMBIAR LA CONTRASEÑA PARA DOCUMENTOS PRIVADOS ----------------
    function updatePassword($password){
        try {
            $p=1;
            $sql = "UPDATE acceso_doc SET pass = ? WHERE id_doc = ?";
            $query = $this->cnx->prepare($sql);
            $encrypt = password_hash($password,PASSWORD_BCRYPT);
            $query-> bindParam(1,$encrypt);
            $query-> bindParam(2,$p);
            $insert = $query -> execute();
            echo "successPassword";
        }catch (PDOException $th) {
            echo "errorPassword";
        }
    }
}
?>