<!-- FORMULARIO PARA CREAR CATEGORIA -->
<?php 
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../admin.php");
    }
include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Agregar Categoria </h1>

            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="categoria">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-categoria">
                            <span class="categoria-color input-group-text" id="basic-addon1">CATEGORIA:</span>
                            <input id="text" type="text" name="categoria"  class="form-control"  required placeholder="Ingresar la categoria"  aria-label="Username" aria-describedby="basic-addon1">
                            <p class="formInputError">La categoria debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit" id="button">Agregar</button>
                </div>
            </form>
    </div>
<script src="../../js/create.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>
