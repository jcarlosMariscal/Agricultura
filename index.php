<?php 
  require  "template/head.php";
  require "template/header.php";
  require "sections/Inicio.php";
  $query = new Inicio();
  $arrNews = $query->createArr("id_noticia","noticia");
  $destacados = count($arrNews);
?>
<!--------------------- PÁGINA DE INICIO ---------------------------->
<div class="container bg">
  <br>
  <!--slider-->
  <div id="carouselExampleIndicators" class="carousel slider" data-bs-ride="carousel">
    <div class="carousel-inner slider">
      <div class="carousel-item active">
        <img src="img/agri.jpg">
      </div>
      <div class="carousel-item ">
        <img src="img/agri2.jpg">
      </div>
      <div class="carousel-item">
        <img src="img/agri3.jpg">
      </div>
    </div>
    <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>
  <br>
  <!--slider-->
  <!--Noticia-->  
  <div class="">
    <br>
    <?php 
    if($destacados>=1){
      ?><h3 class="text-center" class='font-weight-light'>Destacados</h3><?php
    }
    ?>
    <hr>
    <div class="bd-example efct1">
      <section>
          <?php
          if($destacados){
          $news1 = $query->readNewsDestacados($arrNews[$destacados-1]);
          $res1 = $news1->fetch();
          // $titulo = $query->cleanUrl($res1['titulo']);
          ?>
          <div class="container text-center bg efe">
              <h4 class="text-black efe"><a href="noticia/<?php echo $res1['id_noticia']; ?>" class="enlace-not"><?php echo $res1['titulo']; ?></a></h4>
              <p class="lead text-black"></p>
              <?php
              $image = $query->getImage($res1['id_noticia']);
              if($image){
                foreach($image as $img){
                ?><img src="<?php echo $img['archivo'];?>" alt="<?php echo $img['nom_foto'];?>" class="responsive-img img-destacados"><?php
                }
              }
              ?>
              <br>
          </div>
          <br>
          <hr>
          <?php
          if($destacados >= 2){
            $news2 = $query->readNewsDestacados($arrNews[$destacados-2]);
            $res2 = $news2->fetch();
            ?>
          <div class="container text-center bg efe">
              <h4 class="text-black efe"><a href="noticia/<?php echo $res2['id_noticia']; ?>" class="enlace-not"><?php echo $res2['titulo']; ?></a></h4>
              <p class="lead text-black"></p>
              <?php
              $image = $query->getImage($res2['id_noticia']);
              if($image){                    
                foreach($image as $img){
                  ?><img src="<?php echo $img['archivo'];?>" alt="<?php echo $img['nom_foto'];?>" class="responsive-img img-destacados"><?php
                }
              }
              ?>
              <br>
          </div>
          <br>
          <?php 
          }
        ?>
      </section>
      <br>
      <!--Noticia-->
      <!--galeria-->
      <div class="row">
        <?php
        if($destacados >= 3){
          $moreNews = $query->readMoreNews($arrNews[$destacados-1],$arrNews[$destacados-2]);
          if($moreNews){
            foreach($moreNews as $more){
              ?>
              <div class="col-3">
                <div class="border art">
                  <div class="">
                    <?php
                      $image = $query->getImageOne($more['id_noticia']); 
                      if(!$image){
                        ?><img src="https://programacion.net/files/article/20160819020822_image-not-found.png" alt="Imágen no disponible" class="responsive-img img-news_more"><?php
                      }else{
                        $img = $image->fetch();
                          ?>
                          <img src="<?php echo $img['archivo'];?>" alt="<?php echo $img['nom_foto'];?>" class="responsive-img img-news_more">
                          <?php
                      }
                    ?>
                  </div>
                  <div class="title">
                    <h6><a href="noticia/<?php echo $more['id_noticia']; ?>" class="enlace-not"><?php echo $more['titulo']; ?></a></h6>
                  </div>
                  <div class="des">
                    <p><?php echo $more['descripcion'];?></p>
                  </div>
                  <div class="btn-more">
                    <a href="noticia/<?php echo $more['id_noticia']; ?>" class='btn-success btn-sm'>Leer más</a>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        }
      }
        ?>
      </div>
      <br>
      <!--galeria-->
    </div>
  </div>
</div>
<br>
<?php 
    require "template/footer.php";
    require "template/scripts.php";
?>