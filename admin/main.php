<!-- ARCHIVO PRINCIPAL DEL ADMINISTRADOR, SE CARGAN LOS COMPONENTES NECESARIOS Y DE ACUERDO A LA OPCIÓN QUE SE SELECCIONE SE VA LLAMANDO EL ARCHIVO CON EL CONTENIDO DE UNA SECCIÓN -->
<?php 
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../admin.php");
    }

    include('../includes/headerAdmin.php');
    ?>
<?php
    if(isset($_GET['p'])) {
        $page = $_GET['p'];
    }else{
        $page = "galeria";
    }
    switch ($page) {
        case 'galeria':
            include "main/mainGalery.php";
            break;
        case 'documentos':
            include "main/mainDocuments.php";
            break;
        case "noticias":
            include "main/mainNews.php";
            break;
        case "categoria":
            include "main/mainCategory.php";
            break;
        case "directorio":
            include "main/mainDirectory.php";
            break;
        default:
            include "main/mainGalery.php";
            break;
    }

include "../includes/footerAdmin.php"
?>
<script>
    let msj = localStorage.getItem("msj");
    // console.log(msj);
    if(msj === "true"){
        Swal.fire({
            title: "Bievenido <?php echo $_SESSION["admin"]["nombre"]; ?>!",
            text: "Esta es la interfaz principal, seleccione una opción",
            icon: "success",//error, 
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            confirmButtonColor: '#47874a',
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("msj");
    }, 2000);
</script>