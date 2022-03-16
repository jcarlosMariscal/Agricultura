<?php
// <!-- ESTA CLASE TIENE MÉTODOS PARA EL REGISTRO Y LOGIN DEL USUARIO. -->
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/RegisterDB.php"){
    header("Location: index.php");
}
session_start();
include "config/Connection.php";
class RegisterDB{
    public $cnx;
    public $helper;
    function __construct(){ 
        $this -> cnx = Connection::connectDB();
    }

    // VERIFICA SI EXISTE UN ADMINISTRADOR
    function validateAdmin(){
        $sql = "SELECT * FROM administrador";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query->rowCount();
        }
    }

    // REGISTRA UN ADMINISTRADOR Y ENCRIPTA LA CONTRASEÑA
    function checkInAdmin($nombre,$password){
        try {
            $sql = "INSERT INTO administrador(nombre, pass) VALUES (?,?)";
            $query = $this->cnx->prepare($sql);
            $encrypt = password_hash($password,PASSWORD_BCRYPT);
            $arrData = array($nombre,$encrypt);
            $insert = $query -> execute($arrData);
            echo "successLogin";
        }catch (PDOException $th) {
            echo "errorLogin";
        }
    }

    // INICIO DE SESIÓN
    function login($nombre,$password){
        $sql = "SELECT * FROM administrador WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        if($query->execute()){
            foreach($query as $data){
                if(password_verify($password,$data['pass']) && $nombre === $data['nombre']){
                    $this->updateFailedAttempts("administrador",NULL,"id_admin",$data['id_admin']);
                    $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
                    return true;
                }else{
                    if($data['intentos'] < 2){
                        $intentos = $data['intentos']+1;
                        $this->updateFailedAttempts("administrador",$intentos,"id_admin",$data['id_admin']);
                    }else{
                        echo "limite";
                    }
                    return false;
                }
            }
        }
    }
    // function updateFailedAttempts($table,$intentos, $field, $value){
    //     $sql = "UPDATE $table SET intentos = ? WHERE $field = ?";
    //     $query = $this->cnx->prepare($sql);
    //     $query -> bindParam(1,$intentos);
    //     $query -> bindParam(2,$value);
    //     $query->execute();
    // }
}
?>