<?php
// <!-- CLASE CON FUNCIONES PARA ELIMINAR REGISTROS -->
include "../../config/Connection.php";
class Delete{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
    }

    function validate($table,$id){
        if($table === "galeria"){
            $sql = "SELECT id_noticia FROM galeria WHERE id_foto = ?";
        }
        if($table === "categoria"){
            $sql = "SELECT id_noticia FROM noticia WHERE categoria = ?";
        }
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        $query->execute();
        switch ($table) {
            case 'galeria':
                $data = $query->fetch();
                if($data['id_noticia'] !== NULL)return true;
                return false;
                break;
            case "categoria":
                if($query->rowCount() >= 1) return true;
                return false;
                break;
            default:
                return true;
                break;
        }
    }


    function deleteGalery($id_foto){
        try {
            $sql = "DELETE FROM galeria WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_foto);
            $insert = $query -> execute();
            return "deleted";
        } catch (PDOException $th) {
            return "error";
        }
    }
    // CATEGORIA
    function deleteCategory($id_categoria){
        try {
            $sql = "DELETE FROM categoria WHERE id_categoria = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_categoria);
            $delete = $query -> execute();
            return "deleted";
        }catch (PDOException $th) {
            return "error";
        }
    }
    // CATEGORIA
    // NOTICIA
    function getImageNews($id_noticia){
        $sql = "SELECT id_foto FROM galeria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_noticia);
        $select = $query->execute();
        if($select){
            $images = array();
            $i=0;
            while($data = $query->fetch()){
                $images[$i] = $data['id_foto'];
                $i++;
            }
            return $images;
        }
    }
    function deleteImageNews($id_noticia){
        $images = $this->getImageNews($id_noticia);
        if(count($images) === 0){
            return true;
        }else{
            foreach($images as $data){
                $sql = "UPDATE galeria SET id_noticia = ? WHERE id_foto = ?";
                $query = $this->cnx->prepare($sql);
                $arrData = array(NULL, $data);
                $delete = $query -> execute($arrData);
            }
            return true;
        } 
    }
    function deleteNews($id_noticia){
        try {
            $delete = $this->deleteImageNews($id_noticia);
            if($delete){
                $sql = "DELETE FROM noticia WHERE id_noticia = ?";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$id_noticia);
                $insert = $query -> execute();
                return "deleted";
            }
        } catch (PDOException $th) {
            return "error";
        }
    }
    // NOTICIA

    // DOCUMENTO
    function deleteDocument($id_documento){
        try {
            $sql = "DELETE FROM documento WHERE id_documento = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_documento);
            $delete = $query -> execute();
            return "deleted";
        } catch (PDOException $th) {
            return "error";
        }
    }
    // DOCUMENTO

    // DIRECTORIO
    function deleteDirectory($id_directorio){
        try {
            $sql = "DELETE FROM directorio WHERE id_directorio = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_directorio);
            $delete = $query -> execute();
            return "deleted";
        } catch (PDOException $th) {
            return "error";
        }
    }
    // DIRECTORIO
}

