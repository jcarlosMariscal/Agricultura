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

    // DEVUELVE LOS DATOS DE UN REGISTRO EN ESPECIFICO PARA IMPRIMIRLO EN EL FORMULARIO
    function readGalery($id_foto){
        $sql = "SELECT * FROM galeria WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id_foto);
        if($query->execute()){
            return $query;
        }
    }
    // RECIBE LOS NUEVOS DATOS PARA ACTUALIZARLOS
    function updateGalery($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto){
        $sql = "UPDATE galeria SET nom_foto = ?, archivo = ?, descripcion = ?, fecha_modi = ? WHERE id_foto = ?";
        $query = $this->cnx->prepare($sql);
        $arrData = array($nom_foto,$archivo,$descripcion,$fecha_modi,$id_foto);
        $insert = $query -> execute($arrData);
        // LLAMA UNA FUNCIÓN AUXILIAR PARA MANDAR UN MENSAJE EXITOSO O ERRÓNEO.
        $this -> helper->validateInsert($insert,"La imagen $nom_foto se  ha modificado", "../main.php?p=galeria");
    }
}
?>