<!-- FORMULARIO PARA AGREGAR UNA NOTICIA -->
<?php
    include "Create.php";
    $query = new Create();
    $category = $query->readCategory();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/admin.css">
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
            <h1 class="welcome text-center " class="categoria-color input-group-text" id="basic-addon1">Agregar Noticia </h1>

            <form method="POST" action="receivedData.php" enctype="multipart/form-data" class ="form">
                <input type="hidden" name="table" value="noticia">
                <div class="card card-container">
                        <div class="center-input input-group">
                            <span class="categoria-color input-group-text" id="basic-addon1">TITULO:</span>
                            <input id="text" type="text" name="titulo"  class="form-control"  required placeholder="Ingresar nombre."  aria-label="Username" aria-describedby="basic-addon1">
                            <span class="icon-left"><i class="zmdi zmdi-check"></i></span>
                            <span class="msj"></span>
                        </div>
                </div>
                <div class="card card-container">
                        <div class="center-input input-group">
                            <span class="categoria-color input-group-text" id="basic-addon1">DESCRIPCION:</span>
                            <input id="text" type="text" name="descripcion"  class="form-control"  required placeholder="Ingresar nombre."  aria-label="Username" aria-describedby="basic-addon1">
                            <span class="icon-left"><i class="zmdi zmdi-check"></i></span>
                            <span class="msj"></span>
                        </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group">
                        <span class="categoria-color input-group-text" id="basic-addon1">CONTENIDO:</span>
                        <textarea id="text" type="text" name="texto" class="form-control" required placeholder="Ingresar departamento." aria-label="Username" aria-describedby="basic-addon1"></textarea>
                        <span class="icon-left"><i class="zmdi zmdi-check"></i></span>
                        <span class="msj"></span>
                    </div>
                </div>
                <div class="card card-container">
                    <div class="center-input input-group">
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
                        <span class="icon-left"><i class="zmdi zmdi-check"></i></span>
                        <span class="msj"></span>
                    </div>
                </div>
                <div class="form-signin btn-form">
                    <button class="btn" type="submit">Ingresar</button>
                </div>
            </form>
    </div>

    <footer>
        <hr size="10" style="background: green;">
        <img class="img-abajo img-fluid" src="../../img/comite.png" width="200px" alt="">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </footer><div class="barra-abajo">
</body>

