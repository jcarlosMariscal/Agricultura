<!-- FORMULARIO PARA CREAR DOCUMENTOS -->
<?php 
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../../index.php");
    }
include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Agregar documento </h1>

            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="documento">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-nombre">
                            <span class="categoria-color input-group-text" id="basic-addon1">NOMBRE:</span>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar nombre del documento"  aria-label="Username" aria-describedby="basic-addon1">
                            <i class="input-icon bi"></i>
                            <p class="formInputError">El nombre debe tener un mínimo de 5 caracteres y no debe exceder de 100.Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-descripcion">
                        <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingresar una descripción" aria-label="Username" aria-describedby="basic-addon1">
                        <i class="input-icon bi"></i>
                        <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-archivo">
                        <span class="categoria-color input-group-text" id="basic-addon1">ARCHIVO:</span>
                        <input type="file" name="archivo" id="archivo" accept=".pdf" class="" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError" id="inputFile">Seleccione un archivo</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-privacidad">
                        <span class="categoria-color input-group-text" id="basic-addon1">PRIVACIDAD:</span>
                        <select name="privacidad" id="privacidad" class="select">
                            <option value="1">Público</option>
                            <option value="2">Privado</option>
                        </select>
                        <p class="formInputError"></p>
                    </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit" id="button">Agregar</button>
                </div>
            </form>
    </div>

<script src="../../js/create.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>
