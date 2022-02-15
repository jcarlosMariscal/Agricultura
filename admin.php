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
        <form class="form-signin" id="admin">
            <div >
                <input type="text" name="table" value="login" hidden>
            </div>
            <div id="group-nombre">
                <input type="text" name="nombre" id="nombre" class="login_box" placeholder="Ingrese su nombre">
                <p class="formInputError">El nombre no debe estar vacío, debe tener un mínimo de 3 y un máximo de 30 caracteres.</p>
            </div>
            <div id="group-password">
                <input type="password" name="password" id="password" class="login_box" placeholder="Ingrese su contraseña">
                <p class="formInputError">La contraseña debe tener mínimo 8 caracteres, al menos una letra y un número</p>
            </div>

            <div class="formOneGrupo formMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div>
            <div class="formOneGrupo formMensaje" id="error-datos">
                <p><b>Error: </b>No se pudo iniciar sesión, verifique que sus datos sean correctos.</p>
            </div>
            <button class="btn-admin" type="submit" id="button">Iniciar sesión</button>
        </form>
    </div>
</div>
<!-- FORMULARIO DE INICIO DE SESIÓN DEL ADMINISTRADOR -->
<script src="js/validate.js" type="module"></script>