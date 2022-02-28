<?php
// <!-- CLASE AUXILIAR, CONTIENE FUNCIONES QUE REALIZAN CIERTA FUNCIÓN, SI SE NECESITA EN ALGUNA SECCIÓN SOLO SE INVOCA -->
class Helper{
    // GENERA UNA RUTA PARA MOVER EL ARCHIVO Y OTRA PARA ALMACENAR EN LA BASE DE DATOS.
    function generateRoute($file,$route){
        if($file){
            $name_arch = basename($file['name']);
            $name_mod = date("m-d-y").$name_arch;
            $routeMove = "../../../archivos/$route/" . $name_mod;
            $routeInsert = "archivos/$route/" . $name_mod;
            return [$routeMove,$routeInsert];
        }
    }

    // LLAMA A LA FUNCIÓN PARA GENERAR RUTAS, OBTIENE LA RUTA PARA MOVER UN ARCHIVO Y HACE UNAS VALIDACIONES.
    function uploadFile($file,$route){
        $route = $this->generateRoute($file,$route);
        $routeMove = $route[0];
        if(isset($file) && !empty( $file['name'])){
            $uploadFile = move_uploaded_file($file["tmp_name"],$routeMove);
            return "true";
        }else{
            return "false";
        }
    }

    // CONSULTAS BD
    function readTitleNews($id_noticia,$cnx){
        $sql = "SELECT titulo FROM noticia WHERE id_noticia = ?";
        $query = $cnx->prepare($sql);
        $query -> bindParam(1, $id_noticia);
        if($query->execute()){
            return $query;
        }
    }
    function readCategory($cnx){
        $sql = "SELECT id_categoria, categoria FROM categoria";
        $query = $cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function readCategoryID($cnx, $id){
        $sql = "SELECT C.id_categoria,C.categoria FROM noticia N INNER JOIN categoria C ON C.id_categoria = N.categoria WHERE N.id_noticia = ?";
        $query = $cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function readPrivacityForm($cnx,$id){
        $sql = "SELECT privacidad FROM documento WHERE id_documento = ?";
        $query = $cnx->prepare($sql);
        $query->bindParam(1, $id);
        if($query->execute()){
            return $query;
        }
    }
    // Validar si el registro existe antes de mostrar formulario de modificación
    function idUpdate($cnx,$table,$field,$id){
        $sql = "SELECT $field FROM $table WHERE $field = ?";
        $query = $cnx->prepare($sql);
        $query -> bindParam(1,$id);
        $query->execute();
        if($query->rowCount() === 0){
            return false;
        }
        return true;
    }
}
?>