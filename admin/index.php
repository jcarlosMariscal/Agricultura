<?php
// <!-- FORMULARIO DE INICIO DE SESIÓN DEL ADMINISTRADOR -->
session_start();
if (isset($_SESSION["admin"])){
    header("Location: main.php");
}
    include "template/head.php";
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
<body class="bc">
    <div class="container">
        <br>
        <div class="card card-container">
            <img  src="../img/comite.png" class="logo" width="250px" alt="">
            <h2 class="welcome text-center">Bienvenido</h2>
            <?php
                // VALIDAR SI EXISTE UN ADMINISTRADOR
                if($validate === 0){
                    ?><p class="text-center"><a href="registerForm.php" class="err-admin">Aún no existe un administrador en la base de datos, por favor agreguelo</a></p><?php
                }else{
                    ?><p class="text-center">Inicie sesión</p><?php
                }
            ?>
            <hr size="4" style="color: #47874a;">
            <noscript>
                <p class="text-center">
                    Javascript está deshabilitado en su navegador web.<br />
                    Por favor, para que este sitio funcione,<br />
                    <b><i>habilite javascript</i></b>.<br />
                    <br/>
                </p>
            </noscript>
            <form class="form-signin" id="admin">
                <div>
                <input type="hidden" name="table" value="login">
                </div>
                <div class="card card-container sec-admin">
                        <div class="center-input input-group" id="group-nombre">
                            <!-- <span class="categoria-color input-group-text" id="basic-addon1">Nombre:</span> -->
                            <input type="text" name="nombre" id="nombre" class="login_box" placeholder="Ingrese su nombre">
                            <i class="input-icon icon-admin bi"></i>
                            <p class="formInputError">El nombre no debe estar vacío, debe tener un mínimo de 3 y un máximo de 30 caracteres.</p>
                        </div>
                </div>
                <div class="card card-container sec-admin">
                        <div class="center-input input-group" id="group-password">
                            <!-- <span class="categoria-color input-group-text" id="basic-addon1">Nombre:</span> -->
                            <input type="password" name="password" id="password" class="login_box" placeholder="Ingrese su contraseña">
                            <i class="input-icon icon-admin bi"></i>
                            <p class="formInputError">La contraseña debe tener mínimo ocho caracteres, al menos una letra mayúscula, una letra minúscula y un número</p>
                        </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="formOneGrupo formMensaje" id="error-datos">
                    <p><i class="bi bi-x-circle-fill"></i><b>Error: </b>No se pudo iniciar sesión, verifique que sus datos sean correctos.</p>
                </div>
                    <button class="btn-admin" type="submit" id="button"><i class="bi bi-box-arrow-in-right"></i>Iniciar sesión</button>
            </form>
        </div>
    </div>
</body>
<script src="js/create.js" type="module"></script>
</html>