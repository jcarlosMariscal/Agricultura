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

    // ------------------------------- CONSULTAS BD ---------------------------
        // OBTENER TITULO DE LA NOTICIA
    function readTitleNews($id_noticia,$cnx){
        $sql = "SELECT titulo FROM noticia WHERE id_noticia = ?";
        $query = $cnx->prepare($sql);
        $query -> bindParam(1, $id_noticia);
        if($query->execute())  return $query;
    }
        // OBTENER CATEGORIAS
    function readCategory($cnx){
        $sql = "SELECT id_categoria, categoria FROM categoria";
        $query = $cnx->prepare($sql);
        if($query->execute()) return $query;
    }
        // OBTENER UNA CATEGORIA POR SU ID
    function readCategoryID($cnx, $id){
        $sql = "SELECT C.id_categoria,C.categoria FROM noticia N INNER JOIN categoria C ON C.id_categoria = N.categoria WHERE N.id_noticia = ?";
        $query = $cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()) return $query;
    }
        // OBTENER LA PRIVACIDAD DE UN DOCUMENTO
    function readPrivacityForm($cnx,$id){
        $sql = "SELECT privacidad FROM documento WHERE id_documento = ?";
        $query = $cnx->prepare($sql);
        $query->bindParam(1, $id);
        if($query->execute())return $query;
    }
        // Validar si el registro existe antes de mostrar formulario de modificación
    function idUpdate($cnx,$table,$field,$id){
        $sql = "SELECT $field FROM $table WHERE $field = ?";
        $query = $cnx->prepare($sql);
        $query -> bindParam(1,$id);
        $query->execute();
        if($query->rowCount() === 0)return false;
        return true;
    }
        // OBTENER DIRECTORIO
    function readDirectory($cnx){
        $sql = "SELECT * FROM directorio ";
        $query = $cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
        // OBTENER CATEGORIA DE UNA NOTICIA
    function readCategoryIdNew($id,$cnx){
        $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
        $query = $cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }

    // -------------- PAGINADOR ------------------------
    function paginador($id,$tabla,$recibido,$rango,$privacidad=NULL,$cnx){
        $cantidad_pagina  = $rango;
        if($privacidad === "todo" && $tabla === "documento"){
            $sql = "SELECT $id FROM $tabla ";
            $query = $cnx->prepare($sql);
        }else if($privacidad != "todo" && $tabla === "documento"){
            $sql = "SELECT $id FROM $tabla WHERE privacidad = ? ";
            $query = $cnx->prepare($sql);
            $query->bindParam(1,$privacidad);
        }else{
            $sql = "SELECT $id FROM $tabla ORDER BY $id ASC";
            $query = $cnx->prepare($sql);
        }
        $pagina = ($recibido == 1)? 1 : $recibido;
        $inicio = ($pagina-1)*$cantidad_pagina;
        
        if($query->execute()){
            $num_registro = $query->rowCount();
            // echo $num_registro;
            if($tabla === "noticia" && $privacidad == "noAdmin") {
                $num_registro = $num_registro-2;
            }else if($tabla === "noticia" && $privacidad === "admin"){
                $num_registro = $num_registro;
            }
            $total_pag = ceil($num_registro/$cantidad_pagina); //Total paginas
            return array($inicio,$cantidad_pagina,$total_pag,$num_registro);
        }
    }

    // --------------------------- GENERAR ARREGLO CON LOS REGISTROS DE LA CONSULTA -------------------------
    function readTable($id_select,$table,$id,$cnx){
        if($table === "galeNoti"){
            $sql = "SELECT $id_select FROM galeria WHERE id_noticia = ?";
            $query = $cnx->prepare($sql);
            $query->bindParam(1,$id);
        }else{
            $sql = "SELECT $id_select FROM $table ORDER BY $id_select ASC";
            $query = $cnx->prepare($sql);
        }
        if($query->execute()){
            return $query;
        }
    }
    function createArr($id_select,$table,$id,$cnx){
        $t = $this->readTable($id_select,$table,$id,$cnx);
        $arr = [];
        foreach($t as $res){
            array_push($arr,$res[$id_select]);
        }
        return $arr;
    }
}
?>