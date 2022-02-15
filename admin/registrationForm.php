<!-- FORMULARIO DE REGISTRO DEL ADMINISTRADOR -->
<?php
session_start();
if (isset($_SESSION["email"])){
    header("Location: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://fonts.googleapis.com/css?family=Advent+Pro:300&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css"> -->
    <!-- FONT AWESOEM -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>

    hr{
    height: 2px;
    border: 2px solid black;
    border-radius: 10px;
    background: #6AA803;
    }
    </style>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="js/sweetAlert.js"></script> -->
</head>
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
                <input type="text" name="nombre" id="nombre" class="login_box" placeholder="Ingrese su nombre" autofocus>
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
            <button class="btn" type="submit" id="button">Registrar</button>
        </form>
</div>
</body>
<script src="../js/validate.js" type="module"></script>
</html>