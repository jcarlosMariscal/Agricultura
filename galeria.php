<?php
include  "template/head.php";
include "template/header.php";
//  LLAMA A LA CLASE READ PARA USAR UNA FUNCIÓN QUE TRAIGA LOS REGISTROS Y IMPRIMIR EN PANTALLA
  require "src/Read.php";
  $query = new Read();
  $galery = $query->readGalery(); // Acceder al método.
?>

<div class="container bg">
<div class="row">
  <?php
      if($galery){
        foreach($galery as $data){
          $imagen = $data['archivo'];
          $descripción = $data['descripcion'];
          ?>
          <div class="gallery">
            <a target="_blank" href="<?php echo $data['archivo']; ?>">
              <img src="<?php echo $data['archivo']; ?>" alt="Cinque Terre" width="600" height="400" class="galery-img">
            </a>
            <div class="desc"><?php echo $data['descripcion'] ?></div>
          </div>
          <?php
        }
      }
    ?>
</div>
</div>
<br>
<?php 
    include "template/footer.php";
    include "template/scripts.php";
?>
