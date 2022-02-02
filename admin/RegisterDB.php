<?php
include "../config/Connection.php";
include "../helper/Helper.php";
class RegisterDB{
    public $cnx;
    public $helper;
    function __construct(){
        $this -> cnx = Connection::connectDB();
        $this -> helper = new Helper();
    }
    function useHelper($file,$route){
        return $this -> helper->uploadFile($file,$route);
    }

    function validateAdmin(){
        $sql = "SELECT * FROM administrador";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query->rowCount();
        }
    }

    function checkInAdmin($nombre,$password){
        $sql = "INSERT INTO administrador(nombre, pass) VALUES (?,?)";
        $query = $this->cnx->prepare($sql);
        $encrypt = password_hash($password,PASSWORD_BCRYPT);
        $arrData = array($nombre,$encrypt);
        $insert = $query -> execute($arrData);

        $this -> helper->validateInsert($insert,"El administrador se ha registrado, ahora por favor inicie sesión", "../admin");
    }
    function login($nombre,$password){
        $sql = "SELECT * FROM administrador WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        if($query->execute()){
            foreach($query as $data){
                if(password_verify($password,$data['pass'])){
                    $_SESSION["admin"] = $data;
                    header("Location: main.php");
                }else{
                    ?>
                    <script>
                        // alert("Verifique sus datos");
                        window.location.href='../admin.php';
                    </script>
                    <?php
                }
            }
        }  
    }
}
?>