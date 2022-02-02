<?php
class Helper{
    function validateInsert($insert,$message,$redirectTo){

        if(!$insert){
            echo '<script language="javascript">alert("Algo salió mal, no se pudo insertar en la base de datos");
            window.location.href="'.$redirectTo.'.php"
            </script>';
        }else{
            echo '<script language="javascript">alert("'.$message.'");
                    window.location.href="'.$redirectTo.'.php"
                </script>';
            // die();
        }
    }

    function generateRoute($file,$route){
        if($file){
            $name_arch = basename($file['name']);
            $name_mod = date("m-d-y").$name_arch;
            $route = "$route/" . $name_mod;
            return $route;
        }
    }
    function uploadFile($file,$route){
        $route = $this->generateRoute($file,$route);
        if(isset($ubicacion) && !empty( $file['name'])){
            $uploadFile = move_uploaded_file($file["tmp_name"],$route);
            return "true";
        }else{
            return "false";
        }
    }

}
?>