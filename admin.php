<?php
// session_start();
// if (isset($_SESSION["email"])){
//     header("Location: inicio.php");
// }
    include "head.php";
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
<div class="row justify-content-center">
    <button type="submit" class="btn btn-success btn-lg mt-5" disabled>BIENVENIDO</button>
</div>
<br>
<br>
<div class="container">
    <?php
        if($validate === 0){
            ?><h3 class="welcome text-center"><a href="admin/registrationForm.php">Aún no existe un administrador en la base de datos, por favor agreguelo</a></h3><?php
        }
    ?>
    <br>
    <div class="card card-container">
    <img  src="img/comite_nacional_agro.jpg" class="logo" width="250px" alt="">
    <hr size="4" style="color: #47874a;">
    <form id="form" method="post" class="form-signin" action="admin/receivedData.php">
        <input type="text" name="table" value="login" hidden>
        <input type="text" name="nombre" class="login_box" placeholder="Ingrese su nombre"   autofocus>
        <!-- <p class="warning" id="warning">s</p> -->
        <input type="password" name="password" class="login_box" placeholder="Ingrese su contraseña" required>
        <p class="warning" id="warning"></p>
        <button class="btn" type="submit">Ingresar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>