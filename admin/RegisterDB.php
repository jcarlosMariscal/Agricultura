<!-- ESTA CLASE TIENE MÉTODOS PARA EL REGISTRO Y LOGIN DEL USUARIO. -->
<?php
session_start();
include "../config/Connection.php";
include "../helper/Helper.php";
class RegisterDB{
    public $cnx;
    public $helper;
    function __construct(){ 
        $this -> cnx = Connection::connectDB(); // Guarda la conexión en una variable para después usarla.
        $this -> helper = new Helper(); // Crea una instancia de la clase auxiliar.
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
        $sql = "INSERT INTO administrador(nombre, pass) VALUES (?,?)";
        $query = $this->cnx->prepare($sql);
        $encrypt = password_hash($password,PASSWORD_BCRYPT);
        $arrData = array($nombre,$encrypt);
        $insert = $query -> execute($arrData);

        // LLAMA UN MÉTODO DE LA CLASE AUXILIAR PARA MANDAR UNA ALERTA
        $this -> helper->validateInsert($insert,"El administrador se ha registrado, ahora por favor inicie sesión", "../admin.php");
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

    function getAdmin(){
        $sql = "SELECT nombre FROM administrador";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        } 
    }
}
?>