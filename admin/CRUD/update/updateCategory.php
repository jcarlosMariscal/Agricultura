<!-- FORMULARIO PARA CREAR CATEGORIA -->
<?php
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../../index.php");
    }else if(!isset($_GET['id_categoria'])){
        header("Location: ../../main.php");
    }
    
    require "Update.php";
    $query = new Update();
    $id_categoria = $_GET['id_categoria'];
    $idUpdate = $query->idUpdate("categoria","id_categoria",$id_categoria);
    if(!$idUpdate){
        header("Location: ../../main.php?p=noticia");
    }
    $category = $query->readTable("categoria","id_categoria",$id_categoria);
    if($category){
        $result = $category->fetch();
        $categoria = $result['categoria'];
    }
    include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Actualizar categoria </h1>

            <form id="formNoEditor" class ="form">
                <div>
                    <input type="hidden" name="table" value="categoria">
                </div>
                <div>
                    <input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-categoria">
                        <span class="categoria-color input-group-text" id="basic-addon1">CATEGORIA:</span>
                        <input id="text" type="text" name="categoria"  class="form-control"  required value="<?php echo $categoria; ?>"  aria-label="Username" aria-describedby="basic-addon1">
                        <i class="input-icon bi"></i>
                        <p class="formInputError">La categoria debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
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
