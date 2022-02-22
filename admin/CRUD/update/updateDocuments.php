<?php 
require "Update.php";
$query = new Update();
$id = $_GET['id_documento'];

$documents = $query -> readTable("documento","id_documento",$id);
if($documents){
    foreach($documents as $data){
        $id_documento = $data['id_documento'];
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $privacidad = $data['privacidad'];
        $archivo = $data['archivo'];
    }
}
$document = $query->readPrivacityForm();
include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Actualizar Documento:</h1>

            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="documento">
                </div>
                <div>
                    <input type="hidden" name="id_documento" value="<?php echo $id; ?>">
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-nombre">
                        <span class="categoria-color input-group-text" id="basic-addon1">NOMBRE:</span>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>"  aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">El nombre debe tener un mínimo de 5 caracteres y no debe exceder de 100.Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-descripcion">
                        <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-archivo">
                        <span class="categoria-color input-group-text" id="basic-addon1">ARCHIVO:</span>
                        <div class="archivo-class">
                            <input type="file" name="archivo" id="archivo" accept=".pdf" class="" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <p>Documento actual: <b><?php echo $archivo; ?></b></p>
                        <p class="formInputError" id="inputFile">Si selecciona un nuevo documento, la actual será reemplazada</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group">
                        <span class="categoria-color input-group-text" id="basic-addon1">PRIVACIDAD:</span>
                        <?php
                            if($document){
                        ?>
                        <select name="privacidad" id="privacidad">
                            <?php
                                foreach($document as $data){
                                    if($data['privacidad'] === $privacidad){
                                        ?>
                                        <option value="<?php echo $data['privacidad']; ?>" selected>
                                            <?php echo ($data['privacidad'] === 1) ? "Público" : "Privado"; ?>
                                        </option>
                                        <?php
                                        
                                    }
                                }
                                if($privacidad === 1){
                                    ?><option value="2">Privado</option><?php
                                } else if($privacidad === 2){
                                    ?><option value="1">Público</option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit" id="button">Actualizar</button>
                </div>
            </form>
    </div>
<script src="../../js/update.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>

