<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="../img/favicon.png">
    <title>Administrador</title>
</head>
<body>
    <div class="container">
        <!-- MENÚ ADMIN SECCIONES -->
        <div class="letra">
            <img class="imagen img-fluid" src="../img/comite.png" alt="">
            <h3>COMITE NACIONAL DE AGRICULTURA PROTEGIDA Y SUSTENTABLE</h3>
        </div>
        <hr size="10" style="background: green;">
    </div>
    <h1 class="welcome text-center">Bienvenido</h1>
        <h5>Hola <?php echo $_SESSION['admin']['nombre']; ?>, seleccione la opción a modificar</h5>
        <br>
        <div class="usuario-modificar btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
                <a href="galeria" class="btn-inicio btn"><i class="bi bi-images"></i>Galeria</a>
                <!-- <button type="button" class="btn-inicio btn"><i class="bi bi-card-image"></i>Galeria</button> -->
            </div>
            <div class="btn-group me-2" role="group" aria-label="Second group">
                <a href="documentos" class="btn-inicio btn"><i class="bi bi-file-earmark-bar-graph"></i>Documentos</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="noticias" class="btn-inicio btn"><i class="bi bi-newspaper"></i>Noticias</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="categoria" class="btn-inicio btn"><i class="bi bi-bookmark-check"></i>Categoria</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="directorio" class="btn-inicio btn"><i class="bi bi-folder-plus"></i>Directorio</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="cerrar.php" class="btn-inicio btn"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
            </div>
        </div>


