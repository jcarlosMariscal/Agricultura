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
    $images = $query->readImages($id_noticia);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="letra">
            <img class="imagen img-fluid" src="../../img/comite.png" alt="" width="200px">
            <h3>COMITE NACIONAL DE AGRICULTURA PROTEGIDA Y SUSTENTABLE</h3>
        </div>
        <hr size="10" style="background: green;">
    </div>
        <div class="usuario-modificar btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
                <a href="../main.php?p=galeria" class="btn-inicio btn"><i class="bi bi-card-image"></i>Inicio</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="../cerrar.php" class="btn-inicio btn">Cerrar sesión</a>
            </div>
        </div>

        <div class="container">
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Seleccione imagenes para la noticia "<b><?php echo $title; ?></b>"</h1>
            <p style="color: red">Estas son las imágenes actuales de la noticia</p>
            <a href="../create/addImageNews.php?id_noticia=<?php echo $id_noticia; ?>">Agregar otra imagen</p>
            <form id="formNoEditor" enctype="multipart/form-data" class ="form">
                <input type="hidden" name="table" value="imageNews">
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
                                <img src="../../<?php echo $data['archivo'];?>" alt="<?php echo $data['nom_foto']; ?>" class="img-thumbnail">
                                <input type="checkbox" id="check<?php echo $id; ?>" name="id_foto" value="<?php echo $data['id_foto']; ?>" class="check_foto" checked>
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
        </div>
    <footer>
        <hr size="10" style="background: green;">
        <img class="img-abajo img-fluid" src="../../img/comite.png" width="200px" alt="">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </footer><div class="barra-abajo">
    <script src="../../js/update.js" type="module"></script>
</body>

