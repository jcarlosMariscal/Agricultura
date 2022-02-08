<!-- CLASE CON FUNCIONES PARA ELIMINAR REGISTROS -->
<?php
include "../../config/Connection.php";
include "../../helper/Helper.php";
class Delete{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }
    function getRoute($file,$route){
        return $this->helper->generateRoute($file,$route);
    }

    function deleteGalery($id_foto){
        $sql = "DELETE FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_foto);
        $insert = $query -> execute();

        $this -> helper->validateInsert($insert,"La imagen se ha eliminado", "../main.php?p=galeria");
    }
    // CATEGORIA
    function deleteCategory($id_categoria){
        $sql = "DELETE FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_categoria);
        $delete = $query -> execute();

        $this -> helper->validateInsert($delete,"La categoria se ha eliminado", "../main.php?p=categoria");
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
        if(count($images) == 0){
            return true;
        } 
        foreach($images as $data){
            $sql = "UPDATE galeria SET id_noticia = ? WHERE id_foto = ?";
            $query = $this->cnx->prepare($sql);
            $arrData = array(NULL, $data);
            $delete = $query -> execute($arrData);
            if($delete){
                return true;
            }
        }
        
        // $this -> helper->validateInsert($insert,"Eliminando relación entre la noticia y imagenes", "../main.php?p=noticias");
    }
    function deleteNews($id_noticia){
        $delete = $this->deleteImageNews($id_noticia);
        if($delete){
            $sql = "DELETE FROM noticia WHERE id_noticia = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_noticia);
            $insert = $query -> execute();
    
            $this -> helper->validateInsert($insert,"La noticia se ha eliminado", "../main.php?p=noticias");
        }
    }
    // NOTICIA

    // DOCUMENTO
    function deleteDocument($id_documento){
        $sql = "DELETE FROM documento WHERE id_documento = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_documento);
        $delete = $query -> execute();

        $this -> helper->validateInsert($delete,"El documento se ha eliminado", "../main.php?p=documentos");
    }
    // DOCUMENTO

    // DIRECTORIO
    function deleteDirectory($id_directorio){
        $sql = "DELETE FROM directorio WHERE id_directorio = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_directorio);
        $delete = $query -> execute();

        $this -> helper->validateInsert($delete,"El registro se ha eliminado", "../main.php?p=directorio");
    }
    // DIRECTORIO
}

