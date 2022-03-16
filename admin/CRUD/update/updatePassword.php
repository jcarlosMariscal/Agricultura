<?php 
    include "../../template/headerForm.php";
    ?>
            <div class="container">
                <br>
                <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1"><span hidden>docsPriv</span>Modificar contraseña para documentos privados </h1>
    
                <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                    <div>
                        <input type="hidden" name="table" value="docsPriv">
                    </div>
                    <div class="card card-container">
                        <div class="center-input input-group" id="group-password">
                            <!-- <span class="categoria-color input-group-text" id="basic-addon1">Nombre:</span> -->
                            <span class="categoria-color input-group-text" id="basic-addon1">CONTRASEÑA:</span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña">
                            <i class="input-icon icon-admin bi"></i>
                            <p class="formInputError">La contraseña debe tener mínimo ocho caracteres, al menos una letra mayúscula, una letra minúscula y un número</p>
                        </div>
                    </div>
                    <div class="formGrupo formMensaje" id="formulario-mensaje">
                        <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                    </div>
                    <div class="form-signin btn-form">
                        <button class="btn" type="submit" id="button"><i class="bi bi-shield-plus"></i>Registrar</button>
                    </div>
                </form>
        </div>
    <script src="../../js/update.js" type="module"></script>
    <?php include "../../template/footerForm.php"; ?>