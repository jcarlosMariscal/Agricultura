<?php
session_start();
if (isset($_SESSION["email"])){
    header("Location: inicio.php");
}
include "../head.php"
?>
<link rel="stylesheet" href="../css/estilos.css">
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
    <img  src="img/comite_nacional_agro.jpg" class="logo" width="250px" alt="">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>