<?php 
    include  "../template/head.php";
    include "../template/header.php";
    require "Read.php";
    $recibido = (isset($_GET['pagina']))? $_GET['pagina']: 1;
    $rango = 3;
    $query = new Read;
    $arrNews = $query->createArr("id_noticia","noticia");
?>
<div class="container bg">
<br>
  <h2 class="text-center" class="font-weight-light"> NOTICIAS </h2>
<hr>
<!-------------------------------------------------noticias importantes-------------------------------------------->
<section class="slice animate-hover-slide bg-white">
    <div class="wp-section">
        <div class="container">
            <div class="section-title-wr  style-2 base base-al"></div>
                <div class="row wp-block-body light">  
                    <?php
                    $destacados = count($arrNews);
                    $news1 = $query->readNewsDestacados($arrNews[$destacados-1]);
                    $res1 = $news1->fetch();
                    ?>  
                    <div class='col-md-6'>
                        <div class='wp-block article grid'>
                            <div class='article-image'>
                                <?php
                                    $image1 = $query->getImageOne($res1['id_noticia']);
                                    if(!$image1){
                                        ?><img src="https://programacion.net/files/article/20160819020822_image-not-found.png" alt="Imágen no disponible" class="sec-noti-img"><?php  
                                    }else{
                                        $res = $image1->fetch();?>
                                        <img src="<?php echo $res['archivo'];?>" alt="<?php echo $res['nom_foto'];?>" class="sec-noti-img">
                                        <?php
                                    }
                                ?>
                            </div>
                            <br>
                            <h5 class='title'><?php echo $res1['titulo'];?></h5>
                            <p class=""><?php echo $res1['descripcion'];?></p>
                            <div class="btn-more">
                                <a href="noticia/<?php echo $res1['id_noticia']; ?>" class='btn-success btn-sm'>Leer más</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($destacados >= 2){
                        $news2 = $query->readNewsDestacados($arrNews[$destacados-2]);
                        $res2 = $news2->fetch();
                        ?>
                    <div class='col-md-6'>
                        <div class='wp-block article grid'>
                            <div class='article-image'>
                                <?php
                                    $image2 = $query->getImageOne($res2['id_noticia']);
                                    if(!$image2){
                                        ?><img src="https://programacion.net/files/article/20160819020822_image-not-found.png" alt="Imágen no disponible" class="sec-noti-img"><?php  
                                    }else{
                                        $res = $image2->fetch();?>
                                        <img src="<?php echo $res['archivo'];?>" alt="<?php echo $res['nom_foto'];?>" class="sec-noti-img">
                                        <?php
                                    }
                                ?>
                        </div>
                        <br>         
                        <h5 class='title'><?php echo $res2['titulo'];?></h5>
                        <p class=""><?php echo $res2['descripcion'];?></p>
                        <div class="btn-more">
                            <a href="noticia/<?php echo $res2['id_noticia']; ?>" class='btn-success btn-sm'>Leer más</a>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
            </div> 
        </div>
    </div>
</section>
<!--------------------------------------------------------------------------------------------------------------->
            <br>
  
<!----------------------------------------Secciones de noticias -------------------------------------------------->
            <section class="slice relative bg-white bb animate-hover-slide">
                <div class="wp-section">
                    <div class="container">
                        <div class="section-title-wr">
                           <h4 class="section-title left text-center"><span>Ultimas Noticias</span></h4>
                        </div>
                        <div id="carouselWork" class="carousel carousel-3 slide animate-hover-slide">
                            <div class="carousel-inner">
                                <div class='item active'>
                        <div class='row'>
                <?php
                    $moreNews = $query->readMoreNews($arrNews[$destacados-1],$arrNews[$destacados-2], $recibido,$rango);
                    if($moreNews){
                        foreach($moreNews as $more){
                ?>
                <div class='col-md-4'>
                    <div class='noticias'>
                        <div>
                            <div class=''>
                                <figure>
                                <?php
                                    $image = $query->getImageOne($more['id_noticia']); 
                                    if(!$image){
                                    ?><img src="https://programacion.net/files/article/20160819020822_image-not-found.png" alt="Imágen no disponible" class="img-responsive img-center img-news_more"><?php
                                    }else{
                                    $img = $image->fetch();
                                        ?>
                                        <img src="<?php echo $img['archivo'];?>" alt="<?php echo $img['nom_foto'];?>" class="img-responsive img-center img-news_more">
                                        <?php
                                    }
                                ?>
                                </figure>
                                <h6 class='product-title titulo-more'>
                                    <a class='product-title'><?php echo $more['titulo'];?></a>
                                </h6>
                                <p class="des desc-more"><?php echo $more['descripcion'];?></p>
                                <div class="btn-more">
                                    <a href="noticia/<?php echo $more['id_noticia']; ?>" class='btn-success btn-sm'><span>Leer más...</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
          </div>
       </div>
     </div>
      <br>    
</section>
<?php
    $paginador = $query ->paginador("id_noticia","noticia",$recibido,$rango,"noAdmin");
    $section = "noticias";
    require "../admin/helper/paginador.php";
  ?>
</div>
<br>
<!---------------------------------------------------------------------------------------------------------------------->
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>