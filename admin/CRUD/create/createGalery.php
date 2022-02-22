<!-- FORMULARIO PARA AGREGAR UNA IMAGEN A LA GALERIA -->
<?php 
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../admin.php");
    }
include "../../template/headerForm.php";
?>

        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Agregar Imagen </h1>

            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="galeria">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-nom_foto">
                            <span class="categoria-color input-group-text" id="basic-addon1">NOMBRE DE FOTO:</span>
                            <input type="text" name="nom_foto" id="nom_foto" class="form-control" placeholder="Ingresar nombre."  aria-label="Username" aria-describedby="basic-addon1">
                            <p class="formInputError">El nombre debe tener un mínimo de 5 caracteres y no debe exceder de 60. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-descripcion">
                        <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingresar una descripción" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-archivo">
                        <span class="categoria-color input-group-text" id="basic-addon1">ARCHIVO:</span>
                        <div class="archivo-class">
                            <input type="file" name="archivo" id="archivo" aria-label="Username" aria-describedby="basic-addon1" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <p class="formInputError" id="inputFile">Seleccione una imagen</p>
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

