<!-- FORMULARIO PARA AGREGAR UN COMITÉ AL DIRECTORIO -->
<?php 
    require "Update.php";
    $query = new Update();
    $id = $_GET['id_directorio'];

    $directory = $query -> readTable("directorio","id_directorio",$id);
    if($directory){
        foreach($directory as $data){
            $nombre = $data['nombre'];
            $url = $data['url'];
            $estado = $data['estado'];
            $carrera = $data['carrera'];
            $email = $data['email'];
            $telefono = $data['telefono'];
        }
    }
    include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Actualizar Directorio </h1>

            <form id="formNoEditor" class ="form">
                <div>
                    <input type="hidden" name="table" value="directorio">
                </div>
                <div>
                    <input type="hidden" name="id_directorio" value="<?php echo $id; ?>" id="nombre">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-nombre">
                            <span class="categoria-color input-group-text" id="basic-addon1">NOMBRE:</span>
                            <input type="text" name="nombre"  class="form-control" value="<?php echo $nombre; ?>"  aria-label="Username" aria-describedby="basic-addon1">
                            <p class="formInputError">El nombre debe tener un mínimo de 5 caracteres y no debe exceder de 60Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-url">
                        <span class="categoria-color input-group-text" id="basic-addon1">SITIO OFICIAL:</span>
                        <input type="text" name="url" class="form-control" value="<?php echo $url; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">La URL es incorrecta. Recuerde que no debe exceder de 200</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-estado">
                        <span class="categoria-color input-group-text" id="basic-addon1">ESTADO:</span>
                        <input type="text" name="estado" class="form-control" value="<?php echo $estado; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">El estado debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-carrera">
                        <span class="categoria-color input-group-text" id="basic-addon1">CARRERA:</span>
                        <input type="text" name="carrera" class="form-control" value="<?php echo $carrera; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">La carrera debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-email">
                        <span class="categoria-color input-group-text" id="basic-addon1">E-MAIL:</span>
                        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">El correo electrónico es incorrecto</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-telefono">
                        <span class="categoria-color input-group-text" id="basic-addon1">TELÉFONO:</span>
                        <input id="text" type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>" aria-label="Username" aria-describedby="basic-addon1">
                        <p class="formInputError">El número de teléfono es incorrecto. No debe exceder de 15 caracteres.</p>
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
