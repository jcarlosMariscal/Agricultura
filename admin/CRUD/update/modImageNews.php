<!-- FORMULARIO PARA AGREGAR UNA IMAGEN A LA GALERIA -->
<?php
    include "Update.php";
    $query = new Update();
    $id_noticia = $_GET['id_noticia'];
    $titleNews = $query->readTitleNews($id_noticia);
    if($titleNews){
        $result = $titleNews->fetch();
        $title = $result['titulo'];
    }
    $images = $query->readTable("galeria","id_noticia",$id_noticia);
    include "../../template/headerForm.php";
?>
        <div class="container">
            <h3 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Seleccione imagenes para la noticia "<b><?php echo $title; ?></b>"</h3>
            <p style="color: red" class="text-center">Las imágenes que se muestran son las que están relacionadas con la noticia, seleccione las que desea conservar</p>
            <?php
            if($images->rowCount() === 0){
                ?><p class="text-center">Esta noticia no tiene ninguna imágen actualemente. <a href="../create/addImageNews.php?id_noticia=<?php echo $id_noticia; ?>">¿Quiere agregar una?</a></p><?php
            }else{
                ?><p class="text-center"><a href="../create/addImageNews.php?id_noticia=<?php echo $id_noticia; ?>" >Agregar otra imagen</a></p><?php
            }
            ?>
            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <input type="hidden" name="table" value="imageNewsUp">
                <input type="hidden" name="id_noticia" value="<?php echo $id_noticia; ?>">
                <div class="container bg">
                    <div class="row cuadro">
                        <input type="hidden" name="total" id="total" value="<?php echo $images->rowCount();?>">
                    <?php
                        if($images){
                            $id = 1;
                            foreach($images as $data){
                            ?>
                            <div class="image gal">
                                <img src="../../../<?php echo $data['archivo'];?>" alt="<?php echo $data['nom_foto']; ?>" class="img-thumbnail">
                                <input type="checkbox" id="check<?php echo $id; ?>" name="id_foto" value="<?php echo $data['id_foto']; ?>" class="check_foto" checked>
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
                    <button class="btn text-center" type="submit">Guardar</button>
                </div>
            </form>
        </div>
<script src="../../js/update.js" type="module"></script>
<?php include "../../template/footerForm.php"; ?>

