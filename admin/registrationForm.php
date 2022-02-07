<!-- FORMULARIO DE REGISTRO DEL ADMINISTRADOR -->
<?php
session_start();
if (isset($_SESSION["email"])){
    header("Location: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>
<body></body>
</html>
<br>
<hr>
<div class="row justify-content-center">
    <button type="submit" class="btn btn-success btn-lg mt-5" disabled>REGISTRO DE ADMINISTRADOR</button>
</div>
<br>
<br>
<div class="container">
    <br>
    <div class="card card-container">
    <img  src="../img/comite.png" class="logo" width="250px" alt="">
    <hr size="4" style="color: #47874a;">
    <form id="form" method="post" class="form-signin" action="receivedData.php">
        <input type="text" name="table" value="checkInAdmin" hidden>
        <input type="text" name="nombre" class="login_box" placeholder="Ingrese su nombre"   autofocus>
        <!-- <p class="warning" id="warning">s</p> -->
        <input type="password" name="password" class="login_box" placeholder="Ingrese una contraseña" required>
        <p class="warning" id="warning"></p>
        <button class="btn" type="submit">Registrar</button>
    </form>
</div>
</body>
</html>