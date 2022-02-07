<!-- CLASE AUXILIAR, CONTIENE FUNCIONES QUE REALIZAN CIERTA FUNCIÓN, SI SE NECESITA EN ALGUNA SECCIÓN SOLO SE INVOCA -->
<?php
class Helper{
    // VALIDA SI SE INSERTO UN REGISTRO, MANDA UN MENSAJE EXITOSO O ERRÓNEO AL ADMINISTRADOR Y LO REDIRECCIONA A OTRA PÁGINA.
    function validateInsert($insert,$message,$redirectTo){ 

        if(!$insert){
            echo '<script language="javascript">alert("Algo salió mal, no se pudo insertar en la base de datos");
            window.location.href="'.$redirectTo.'.php"
            </script>';
        }else{
            echo '<script language="javascript">alert("'.$message.'");
                    window.location.href="'.$redirectTo.'"
                </script>';
            // die();
        }
    }

    // GENERA UNA RUTA PARA MOVER EL ARCHIVO Y OTRA PARA ALMACENAR EN LA BASE DE DATOS.
    function generateRoute($file,$route){
        if($file){
            $name_arch = basename($file['name']);
            $name_mod = date("m-d-y").$name_arch;
            $routeMove = "../../archivos/$route/" . $name_mod;
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

}
?>