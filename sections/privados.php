<?php 
    session_start();
    if (!isset($_SESSION["privado"])){
        header("Location: documentos");
    }
    include  "../template/head.php";
    include "../template/header.php";
    require "Read.php";
    $recibido = (isset($_GET['pagina']))? $_GET['pagina']: 1;
    $rango = 1;
    $query = new Read;
    $docs = $query->readDocuments($recibido,$rango,$privacidad=2);
?>
<!-- DOCUMENTOS PÚBLICOS -->
<div class="container bg">
    <br>
    <h2 class="text-center" class="font-weight-light"> DOCUMENTOS PRIVADOS </h2>
    <div class="btn-docCerrar">
        <a href="sections/cerrarPriv.php" class="docCerrar">Cerrar sesión</a>
    </div>
    <hr>
    <section class="sect-doc">
        <div class="wp-section sec-documento">
            <div class='row'>
            <?php
                if($docs){
                foreach($docs as $data){
                    ?>
                    <div class='col-md-4'>
                        <div class='sec-docs'>
                            <!-- <div> -->
                                <div class='documento border'>
                                    <div class="">
                                    <a data-toggle="modal" data-target="#doc<?php echo $data['id_documento'];?>">
                                        <img src="iconos/pdf.png" class="img-fluid icon-doc cursor-p" alt="Responsive image mt-5">
                                        <h5 class="doc-title cursor-p"><?php echo $data['nombre'];?></h5>
                                    </a>
                                    </div>
                                    <div class="doc-desc">
                                        <p class="text-justify"><?php echo $data['descripcion'];?></p>
                                    </div>
                                    <!-- MODAL -->
                                    <div class="modal fade" id="doc<?php echo $data['id_documento'];?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content imagen-gde">
                                                <embed src="http://localhost/Projects/Agricultura/<?php echo $data['archivo'];?>" type="application/pdf" width="100%" height="700px" />
                                            </div>
                                            </div>
                                        </div>
                                    <!-- MODAL -->
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <?php
                }
                }
            ?>
            </div>
            <!-- cierra row -->
        </div>
        <br>    
    </section>
    <?php
    $paginador = $query ->paginador("id_documento","documento",$recibido,$rango,2);
    $section = "privados";
    require "../admin/helper/paginador.php";
    ?>
</div>

<br>
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>
<script>
    let msj = localStorage.getItem("priv");
    if(msj === "true"){
        Swal.fire({
            title: "Bievenido a los documentos privados!",
            text: "Por seguridad, cierre la sesión antes de salir para evitar que otros accedan a esta sección.",
            icon: "success",//error, 
            timer: 5000,
            toast: true,
            position: 'top-end',
            confirmButtonColor: '#47874a',
            confirmButtonText: "Aceptar",
            allowOutsideClick: false,
        }).then((button)=>{
            if(button.isConfirmed === true){
                location.href=`${previous}`;
            }
        });
    } 
    setTimeout(function(){
        localStorage.removeItem("priv");
    }, 5000);
</script>