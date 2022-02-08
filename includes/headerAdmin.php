<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
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
                <a href="main.php?p=galeria" class="btn-inicio btn"><i class="bi bi-card-image"></i>Galeria</a>
                <!-- <button type="button" class="btn-inicio btn"><i class="bi bi-card-image"></i>Galeria</button> -->
            </div>
            <div class="btn-group me-2" role="group" aria-label="Second group">
                <a href="main.php?p=documentos" class="btn-inicio btn"><i class="bi bi-file-earmark"></i>Documentos</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="main.php?p=noticias" class="btn-inicio btn"><i class="bi bi-newspaper"></i>Noticias</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="main.php?p=categoria" class="btn-inicio btn"><i class="bi bi-newspaper"></i>Categoria</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="main.php?p=directorio" class="btn-inicio btn"><i class="bi bi-folder-symlink"></i>Directorio</a>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Third group">
                <a href="cerrar.php" class="btn-inicio btn">Cerrar sesión</a>
            </div>
        </div>
</body>


