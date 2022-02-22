<?php 
require "Update.php";
$query = new Update();
$id = $_GET['id_noticia'];

$news = $query -> readTable("noticia","id_noticia",$id);
$category = $query->readCategory();
if($news){
    foreach($news as $data){
        $titulo = $data['titulo'];
        $texto = $data['texto'];
        $descripcion = $data['descripcion'];
        $categoria = $data['categoria'];
    }
}
include "../../template/headerForm.php";
?>
<div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Actualizar Noticia </h1>

            <form id="formWithEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="noticia">
                </div>
                <div>
                    <input type="hidden" name="id_noticia" value="<?php echo $id; ?>">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-titulo">
                            <span class="categoria-color input-group-text" id="basic-addon1">TITULO:</span>
                            <input id="titulo" type="text" name="titulo"  class="form-control" value="<?php echo $titulo; ?>"  aria-label="Username" aria-describedby="basic-addon1">
                            <p class="formInputError">El titulo debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-descripcion">
                            <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                            <input id="descripcion" type="text" name="descripcion"  class="form-control" value="<?php echo $descripcion; ?>"  aria-label="Username" aria-describedby="basic-addon1">
                            <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-categoria">
                        <span class="categoria-color input-group-text" id="basic-addon1">CATEGORIA:</span>
                        <?php
                            if($category){
                                ?><select name="categoria" id="categoria"><?php
                                foreach($category as $data){
                                    ?>
                                        <option value="<?php echo $data['id_categoria']; ?>"><?php echo $data['categoria']; ?></option>
                                        <?php
                                }
                                ?></select><?php
                            }
                            ?>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-text">
                        <span class="categoria-color input-group-text" id="basic-addon1">CONTENIDO:</span>
                        <input name="texto" id="texto" type="hidden" >
                        <div id="editor" name="editor" class="editor"><?php echo $texto; ?></div>
                        <p class="formInputError">La noticia no puede quedar en blanco. Evite usar algunos caracteres especiales.</p>
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
<script src="../../js/quill/quill.js"></script>
<?php include "../../template/footerForm.php"; ?>

