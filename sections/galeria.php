<?php
require  "../template/head.php";
require "../template/header.php";
//  LLAMA A LA CLASE READ PARA USAR UNA FUNCIÓN QUE TRAIGA LOS REGISTROS Y IMPRIMIR EN PANTALLA
require "Read.php";
$query = new Read();
$recibido = (isset($_GET['pagina']))? $_GET['pagina']: 1;
  $rango = 4;
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
                              <a href="<?php echo $data['archivo']; ?>">
                              <img src="<?php echo $data['archivo'];?>" alt="<?php echo $data['nom_foto'];?>" class="img-responsive img-center img-news_more">
                              </a>
                              <div class="text-justify nom"><?php echo $data['nom_foto'] ?></div>
                          </div>
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
