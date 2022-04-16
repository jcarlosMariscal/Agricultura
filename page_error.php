<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="img/favicon.png">
</head>
<body class = "bc">
    <div class="container m">
        <br>
        <div class="card card-container">
            <img  src="img/error.jpg" class="logo" width="150px" alt="">
            <p class="text-center">Lo sentimos, no se encontró la página</p>
            <a class="text-center" href="inicio">Regresar a Inicio</a>
            <hr size="4" style="color: #47874a;">
            <?php
            session_start();
            if (isset($_SESSION["admin"])){
                ?>
                <h2 class="text-center">Ha iniciado sesión como Administrador.</h2>
                <a class="text-center" href="main">Regresar a interfaz de administrador</a>
                <?php
            }
        ?>
        </div>
    <div>
</body>
</html>