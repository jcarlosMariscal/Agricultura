<?php
// <!-- ESTA CLASE TIENE MÉTODOS PARA EL REGISTRO Y LOGIN DEL USUARIO. -->
session_start();
include "config/Connection.php";
class RegisterDB{
    public $cnx;
    public $helper;
    function __construct(){ 
        $this -> cnx = Connection::connectDB(); // Guarda la conexión en una variable para después usarla.
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
                if(password_verify($password,$data['pass'])){
                    $_SESSION["admin"] = $data; // GUARDA LA SESIÓN PARA USARLO DESPUÉS
                    return true;
                }else{
                    return false;
                }
            }
        }  
    }
}
?>