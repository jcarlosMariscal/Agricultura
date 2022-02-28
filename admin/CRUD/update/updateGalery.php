<?php 
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../../index.php");
    }else if(!isset($_GET['id_foto'])){
        header("Location: ../../main.php");
    }
require "Update.php";
$query = new Update();

$id = $_GET['id_foto'];
$idUpdate = $query->idUpdate("galeria","id_foto",$id);
if(!$idUpdate){
    header("Location: ../../main.php");
}
$galery = $query -> readTable("galeria","id_foto",$id);
if($galery){
    foreach($galery as $data){
        $nom_foto = $data['nom_foto'];
        $archivo = $data['archivo'];
        $descripcion = $data['descripcion'];
    }
}
include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Actualizar imagen en la galeria </h1>
            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="galeria">
                </div>
                <div>
                    <input type="hidden" name="id_foto" value="<?php echo $id; ?>">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-nom_foto">
                            <span class="categoria-color input-group-text" id="basic-addon1">NOMBRE DE FOTO:</span>
                            <input type="text" name="nom_foto" id="nom_foto" class="form-control" value="<?php echo $nom_foto?>"  aria-label="Username" aria-describedby="basic-addon1">
                            <i class="input-icon bi"></i>
                            <p class="formInputError">El nombre debe tener un mínimo de 5 caracteres y no debe exceder de 60. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-descripcion">
                        <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion?>" aria-label="Username" aria-describedby="basic-addon1">
                        <i class="input-icon bi"></i>
                        <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-archivo">
                        <span class="categoria-color input-group-text" id="basic-addon1">ARCHIVO:</span>
                        <div class="archivo-class">
                            <input type="file" name="archivo" id="archivo" aria-label="Username" aria-describedby="basic-addon1" accept="image/png, .jpeg, .jpg, image/gif">
                        </div>
                        <p>Imagen actual: <b><?php echo $archivo; ?></b></p>
                        <p class="formInputError" id="inputFile">Si selecciona una nueva imágen, la actual será reemplazada</p>
                    </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit" id="button">Actualizar</button>
                </div>
            </form>
    </div>
<script src="../../js/update.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>

