<?php
// <!-- FORMULARIO DE REGISTRO DEL ADMINISTRADOR -->
session_start();
if (isset($_SESSION["email"])){
    header("Location: inicio.php");
}
require "RegisterDB.php";
$query = new RegisterDB();
$validate = $query->validateAdmin();
if($validate === 1){
    header('Location:index.php');
}
include "template/head.php";
?>
<body class="bc">
<br>
<hr>
<br>
<br><br><br>
<div class="container">
    <br>
    <div class="card card-container">
        <img  src="../img/comite.png" class="logo" width="250px" alt="">
        <h2 class="welcome text-center">Registro de Administrador</h2>
        <hr size="4" style="color: #47874a;">
        <!-- FORMULARIO DE REGISTRO -->
        <form id="admin" class="form-signin">
            <div>
                <input type="text" name="table" value="checkInAdmin" hidden>
            </div>
            <div id="group-nombre">
                <input type="text" name="nombre" id="nombre" class="login_box" placeholder="Ingrese su nombre">
                <p class="formInputError">El nombre no debe estar vacío, debe tener un mínimo de 3 y un máximo de 30 caracteres.</p>
            </div>
            <div id="group-password">
                <input type="password" name="password" id="password" class="login_box" placeholder="Ingrese su contraseña">
                <p class="formInputError">La contraseña debe tener mínimo ocho caracteres, al menos una letra mayúscula, una letra minúscula y un número</p>
            </div>
            
            <div class="formOneGrupo formMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div>
            <div class="formOneGrupo formMensaje" id="error-datos">
                <p><b>Error: </b>No se pudo iniciar sesión, verifique que sus datos sean correctos.</p>
            </div>
            <button class="btn" type="submit" id="button">Registrar</button>
        </form>
    </div>
<div>
</body>
<script src="js/create.js" type="module"></script>
</html>