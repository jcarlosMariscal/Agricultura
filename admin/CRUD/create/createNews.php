<!-- FORMULARIO PARA AGREGAR UNA NOTICIA -->
<?php
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../../index.php");
    }
    include "Create.php";
    $query = new Create();
    $category = $query->readCategory();
    include "../../template/headerForm.php";
?>
        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Agregar noticia </h1>
            <p class="text-center"><?php 
                if($category->rowCount() === 0){
                echo "Antes de agregar una noticia tiene que agregar una categoria. <a href='createCategory.php'>Agregar</a>";
                }?>
            </p>
            <form id="formWithEditor" enctype="multipart/form-data" class ="form">
                <div>
                    <input type="hidden" name="table" value="noticia">
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-titulo">
                            <span class="categoria-color input-group-text" id="basic-addon1">TITULO:</span>
                            <input id="titulo" type="text" name="titulo"  class="form-control" placeholder="Ingresar el titulo"  aria-label="Username" aria-describedby="basic-addon1">
                            <i class="input-icon bi"></i>
                            <p class="formInputError">El titulo debe tener un mínimo de 5 caracteres y no debe exceder de 100. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                        <div class="center-input input-group" id="group-descripcion">
                            <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                            <input id="descripcion" type="text" name="descripcion"  class="form-control" placeholder="Ingresar nombre."  aria-label="Username" aria-describedby="basic-addon1">
                            <i class="input-icon bi"></i>
                            <p class="formInputError">La descripción debe tener un mínimo de 5 caracteres y no debe exceder de 255. Se permiten caracteres especiales como #, @, $, %, &, (, ).</p>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group" id="group-categoria">
                        <span class="categoria-color input-group-text" id="basic-addon1">CATEGORIA:</span>
                        <?php
                            if($category){
                                ?><select name="categoria" id="categoria" class="select"><?php
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
                        <div id="editor" name="editor" class="editor"></div>
                        <p class="formInputError">El contenido de la noticia no puede tener más de dos espacios juntos y el mínimo de caracteres es de 20</p>
                    </div>
                </div>
                <div class="formGrupo formMensaje" id="formulario-mensaje">
                    <p><i class="bi bi-exclamation-triangle-fill"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit" id="button">Ingresar</button>
                </div>
            </form>
    </div>

<script src="../../js/create.js" type="module"></script>
<script src="../../js/quill/quill.js"></script>
<?php include "../../template/footerForm.php"; ?>

