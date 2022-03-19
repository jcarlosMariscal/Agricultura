<?php 
    require  "../template/head.php";
    require "../template/header.php";
    require "Read.php";
    $recibido = (isset($_GET['pagina']))? $_GET['pagina']: 1;
    $rango = 3;
    $query = new Read;
    $docs = $query->readDocuments($recibido,$rango,$privacidad=1);
?>
<!-- DOCUMENTOS PÚBLICOS -->
<div class="container bg">
    <br>
    <h2 class="text-center" class="font-weight-light"> DOCUMENTOS PÚBLICOS </h2>
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
                                        <h5 class="cursor-p"><?php echo $data['nombre'];?></h5>
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
        </div>
        <br>    
    </section>

    <?php
    $paginador = $query ->paginador("id_documento","documento",$recibido,$rango,1);
    $section = "documentos";
    require "../admin/helper/paginador.php";
    ?>
</div>

<br>
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>