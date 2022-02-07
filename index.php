<!-- Archivo de inicio, se incluyen el head, header, footer y scripts. Dependiendo de la sección se va llamando un archivo con su contenido -->
<?php include "includes/head.php"; ?>
<body>
    <?php include "includes/header.php"; ?>
    <?php
        if(isset($_GET['p'])) {
            $page = $_GET['p'];
        }else{
            $page = "inicio";
        }
        switch ($page) {
            case 'inicio':
                include "src/inicio.php";
                break;
            case 'noticias':
                include "src/noticias.php";
                break;
            case 'directorio':
                include "src/directorio.php";
                break;
            case 'galeria':
                include "src/galeria.php";
                break;
            case 'publicos':
                include "src/publicos.php";
                break;
            case 'privados':
                include "src/privados.php";
                break;
            default:
                include "src/inicio.php";
                break;
        }
    ?>

    <?php 
        include "includes/footer.php"; 
        include "includes/scripts.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


</body>

</html>