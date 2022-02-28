<!-- FORMULARIO PARA AGREGAR UNA IMAGEN A LA GALERIA -->
<?php
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../../index.php");
    }else if(!isset($_GET['id_noticia'])){
        header("Location: ../../main.php");
    }
    include "Create.php";
    $query = new Create();
    $id_noticia = $_GET['id_noticia'];
    $idUpdate = $query->idUpdate("noticia","id_noticia",$id_noticia);
    if(!$idUpdate){
        header("Location: ../../main.php?p=noticias");
    }
    $titleNews = $query->readTitleNews($id_noticia);
    if($titleNews){
        $result = $titleNews->fetch();
        $title = $result['titulo'];
    }
    $images = $query->readImages();
    include "../../template/headerForm.php";
?>
    <!-- SELECCIÓN DE IMAGENES PARA LA NOTICIA -->
        <div class="container">
            <h3 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1"><span hidden>Sección imageNewsUp</span> Seleccione imágenes para "<b><?php echo $title; ?></b>"</h3>
            <?php
                $t = $images->rowCount();
                if($images->rowCount() === 0){
                    ?><p style="color: red" class="text-center">Ya no hay imágenes libres en la galería, agregue más y vuelva aquí después. <a href="../../main.php">Ir a galeria</a></p><?php
                }else{
                    ?><p style="color: red" class="text-center">Las imágenes que se muestran son las que están disponibles, si no encuentra la imagen que busca por favor agreguela a la galeria.</p><?php
                
            ?>
            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <input type="hidden" name="table" value="imageNews">
                <input type="hidden" name="id_noticia" value="<?php echo $id_noticia; ?>">
                <div class="container bg">
                    <div class="row cuadro">
                    <?php
                        if($images){
                            $id = 1;
                            foreach($images as $data){
                            ?>
                            <div class="image gal">
                                <img src="../../../<?php echo $data['archivo'];?>" alt="<?php echo $data['nom_foto']; ?>" class="img-thumbnail">
                                <input type="checkbox" id="check<?php echo $id; ?>" name="id_foto" value="<?php echo $data['id_foto']; ?>" class="check_foto">
                                <!-- <p><?php echo $data['id_foto']; ?></p> -->
                                <label class="check" for="check">Seleccionar</label>
                            </div>
                            <?php
                            $id++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <br><br><br>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit">Guardar</button>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
<script src="../../js/create.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>

