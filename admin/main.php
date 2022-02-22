<?php 
// <!-- ARCHIVO PRINCIPAL DEL ADMINISTRADOR, SE CARGAN LOS COMPONENTES NECESARIOS Y DE ACUERDO A LA OPCIÓN QUE SE SELECCIONE SE VA LLAMANDO EL ARCHIVO CON EL CONTENIDO DE UNA SECCIÓN -->
    session_start();
    if (!isset($_SESSION["admin"])){
        header("Location: ../admin.php");
    }

    include('template/header.php');
    ?>
<?php
    if(isset($_GET['p'])) {
        $page = $_GET['p'];
    }else{
        $page = "galeria";
    }
    switch ($page) {
        case 'galeria':
            include "CRUD/read/mainGalery.php";
            break;
        case 'documentos':
            include "CRUD/read/mainDocuments.php";
            break;
        case "noticias":
            include "CRUD/read/mainNews.php";
            break;
        case "categoria":
            include "CRUD/read/mainCategory.php";
            break;
        case "directorio":
            include "CRUD/read/mainDirectory.php";
            break;
        default:
            include "CRUD/read/mainGalery.php";
            break;
    }

include "template/footer.php"
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