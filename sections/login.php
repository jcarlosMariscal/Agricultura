<?php 
  session_start();
  if (isset($_SESSION["privado"])){
      header("Location: privados");
  }
  include  "../template/head.php";
  include "../template/header.php";
?>
<!-- LOGIN DOCUMENTOS PRIVADOS -->
  <div class="container">
    <br>
    <div class="card card-container">
      <img  src="img/comite.png" class="logo" width="250px" alt="">
      <h1 class="welcome text-center">Documentos privados</h1>
      <hr size="4" style="color: #47874a;">
      <form id="formNoEditor" class="form-signin">
        <div>
          <input type="hidden" name="table" value="docsLogin">
        </div>
        <div class="card card-container">
          <div class="center-input input-group" id="group-password">
            <input type="password" name="password" id="password" class="login_box" placeholder="Ingrese la contraseña">
            <i class="input-icon icon-admin bi"></i>
            <p class="formInputError">La contraseña debe tener mínimo ocho caracteres, al menos una letra mayúscula, una letra minúscula y un número</p>
          </div>
        </div>
        <div class="formGrupo formMensaje" id="formulario-mensaje">
          <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
        </div>
        <div class="formOneGrupo formMensaje" id="error-datos">
          <p><i class="bi bi-x-circle-fill"></i><b>Error: </b>No fue posible acceder, contacte con el administrador para verificar la contraseña.</p>
        </div>
        <button class="btn-admin" type="submit" id="button">Acceder</button>
      </form>
    </div>
    <br>
  </div>
<br>
<script src="admin/js/create.js" type="module"></script>
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>