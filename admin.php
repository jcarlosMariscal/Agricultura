<?php
session_start();
if (isset($_SESSION["admin"])){
    header("Location: admin/main.php");
}
    include "includes/head.php";
    // CONECTARSE A LA BD PARA VERIFICAR SI EXISTE UN ADMINISTRADOR
    include "config/Connection.php";
    $cnx = Connection::connectDB();
    $sql = "SELECT * FROM administrador";
    $query = $cnx->prepare($sql);
    if($query->execute()){
        $validate = $query->rowCount();
    }
?>
<br>
<hr>
<br>
<br><br><br>
<!-- FORMULARIO DE INICIO DE SESIÓN DEL ADMINISTRADOR -->
<div class="container">
    <br>
    <div class="card card-container">
        <img  src="img/comite_nacional_agro.jpg" class="logo" width="250px" alt="">
        <h2 class="welcome text-center">Bienvenido</h2>
        <?php
            // VALIDAR SI EXISTE UN ADMINISTRADOR
            if($validate === 0){
                ?><p class="text-center"><a href="admin/registrationForm.php" class="err-admin">Aún no existe un administrador en la base de datos, por favor agreguelo</a></p><?php
            }else{
                ?><p class="text-center">Iniciar sesión</p><?php
            }
            // VALIDAR SI EXISTE UN ADMINISTRADOR
        ?>
        <hr size="4" style="color: #47874a;">
        <form id="form" method="post" class="form-signin" action="admin/receivedData.php">
            <input type="text" name="table" value="login" hidden>
            <input type="text" name="nombre" class="login_box" placeholder="Ingrese su nombre"   autofocus>
            <input type="password" name="password" class="login_box" placeholder="Ingrese su contraseña" required>
            <button class="btn-admin" type="submit">Iniciar sesión</button>
        </form>
    </div>
</div>
<!-- FORMULARIO DE INICIO DE SESIÓN DEL ADMINISTRADOR -->