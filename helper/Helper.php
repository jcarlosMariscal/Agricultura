<?php
class Helper{
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

    function generateRoute($file,$route){
        if($file){
            $name_arch = basename($file['name']);
            $name_mod = date("m-d-y").$name_arch;
            $routeMove = "../../archivos/$route/" . $name_mod;
            $routeInsert = "archivos/$route/" . $name_mod;
            return [$routeMove,$routeInsert];
        }
    }
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