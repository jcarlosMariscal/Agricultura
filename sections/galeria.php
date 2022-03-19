<?php
require  "../template/head.php";
require "../template/header.php";
//  LLAMA A LA CLASE READ PARA USAR UNA FUNCIÓN QUE TRAIGA LOS REGISTROS Y IMPRIMIR EN PANTALLA
require "Read.php";
$query = new Read();
$recibido = (isset($_GET['pagina']))? $_GET['pagina']: 1;
  $rango = 12;
  $galery = $query->readGalery($recibido,$rango); // Acceder al método.
?>

<div class="container bg">
<br>
  <h2 class="text-center" class="font-weight-light"> GALERIA </h2>
<hr>
<section class="slice relative bg-white bb animate-hover-slide">
  <div class="wp-section sec-galeria">
            <div class='row'>
              <?php
                if($galery){
                  foreach($galery as $data){
                    $imagen = $data['archivo'];
                    $descripción = $data['descripcion'];
                    ?>
                    <div class='col-md-3'>
                      <div class='galeria-img'>
                        <div>
                          <div class='gallery'>
                              <a data-toggle="modal" data-target="#image<?php echo $data['id_foto'];?>">
                              <img src="<?php echo $data['archivo'];?>" alt="<?php echo $data['nom_foto'];?>" class="img-responsive img-center img-news_more cursor-p">
                              </a>
                              <div class="text-justify nom"><?php echo $data['nom_foto'] ?></div>
                          </div>
                          <!-- MODAL -->
                          <div class="modal fade" id="image<?php echo $data['id_foto'];?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content imagen-gde">
                                <img src="<?php echo $data['archivo'];?>" class="img-fluid rounded" alt="">
                              </div>
                              <div class="info-img">
                                <p><b><?php echo $data['nom_foto']; ?></b></p>
                                <p><?php echo $data['descripcion']; ?></p>
                                <p><?php echo $data['fecha_publi']; ?></p>
                              </div>
                            </div>
                          </div>
                          <!-- MODAL -->
                        </div>
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
    $paginador = $query ->paginador("id_foto","galeria",$recibido,$rango);
    $section = "galeria";
    require "../admin/helper/paginador.php";
  ?>
</div>
<br>
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>
