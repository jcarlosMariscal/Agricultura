<?php
$id = $_GET["noticia"];
require "Read.php";
$query = new Read();
$noticia = $query->readNewsId($id);
$getId = $query->readIdNews($id);
if(!$getId) header("Location: ../inicio");
$res = $noticia->fetch();
$arrImage = $query->getImageArrId($id);

$conImg;
if(!$arrImage){
    $imgMain = "https://programacion.net/files/article/20160819020822_image-not-found.png";
    $imgDescription = "Esta noticia no tiene ninguna imágen, si cree que ha ocurrido un error por favor contacté al administrador.";
    $conImg = false;
}else{
    $mainImageId = $arrImage[mt_rand(0, count($arrImage) - 1)];
    $mainImg = $query->readImgId($mainImageId);
    $resMainImg = $mainImg->fetch();
    $imgMain = "../".$resMainImg['archivo'];
    $imgDescription = $resMainImg['descripcion'];
    $conImg = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noticia | <?php echo $res['titulo']; ?></title>
    
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/favicon.png">
</head>
<body class="bc">
  <header>
    <nav>
      <div class="container">
        <div class="row">

          <div class="col-sm-3">
              <div class="logo">
                <a href="index.php?p=inicio"> <img src="../img/comite.png" alt=""></a>
              </div>
          </div>
              
          <div class="col-sm-3"> </div>
            <div class="col-sm-6">
              <div class="enlaces uno" id="enlaces">
                <a class="btn-outline-success" href="../inicio">Inicio</a>
                <a class="btn-outline-success" href="../noticias">Noticias</a>
                <a class="btn-outline-success" href="../directorio">Directorio</a>
                <a class="btn-outline-success" href="galeria">Galeria</a>
                
                
                <div class="btn-group">
                    <a class="btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Documentos</a>
                    <div class="dropdown-menu">
                    <a href="--/documentos" class="dropdown-item">Publicos</a>
                        <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="../login">Privados</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </nav>
  </header> 
    <div class="container bg">
        <br>
        <hr>
        <section class="noticia">
            <div class="titulo">
                <h2 class="text-center" class="font-weight-light"> <?php echo $res['titulo']; ?> </h2>
            </div>
            <div class='noticia-image'>
                <img src="<?php echo $imgMain ?>" alt="Imágen no disponible" class="sec-noti-img"> 
            </div>
            <div class="detalles">
                <p><?php echo $imgDescription; ?></p>
                <?php
                    $cat = $query->readCategoryId($res['categoria']);
                    $resul = $cat->fetch();
                ?>
                <br><br>
                <p>- <?php echo $resul['categoria'];?></p>
                <p><i><?php echo $res['fecha'];?> - Comite Nacional de Agricultura</i></p>
            </div>
            <div class="contenido">
                <?php echo $res['texto']; ?>
            </div>
        </section>
        <?php
            if($conImg){
                ?>
        <section class="more-img-noti">
            <div class="imagen">
                <?php
                $moreImg = $query->readMoreImgId($mainImageId,$id);
                $tot = $moreImg->rowCount();
                if($tot>=1){
                    ?><h4 class="text-center" class="font-weight-light">Más imágenes</h4><?php
                }
                ?>
                <?php
                    if($moreImg){
                        foreach($moreImg as $img){
                            ?>
                            <div class='imagen-noticia'>
                                <a data-toggle="modal" data-target="#image<?php echo $img['id_foto'];?>">
                                    <img src="../<?php echo $img['archivo']; ?>" alt="<?php echo $img['nom_foto']; ?>" class="sec-noti-img cursor-p"> 
                                </a>
                            </div>
                            <!-- MODAL -->
                            <div class="modal fade" id="image<?php echo $img['id_foto'];?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                <div class="modal-content imagen-gde">
                                    <img src="../<?php echo $img['archivo'];?>" class="img-fluid rounded" alt="">
                                </div>
                                <div class="info-img">
                                    <p><b><?php echo $img['nom_foto']; ?></b></p>
                                    <p><?php echo $img['descripcion']; ?></p>
                                    <p><?php echo $img['fecha_publi']; ?></p>
                                </div>
                                </div>
                            </div>
                            <!-- MODAL -->
                            <?php
                        }
                    }
                ?>
            </div>
        </section>
                <?php
            }
        ?>
        <section class="more-img clear">
            <div class="noti-img">
                <br>
                <hr>
                <?php
                $moreNews = $query->readMoNews($res['categoria'],$id);
                $totl = $moreNews->rowCount();
                if($totl>=1){
                    ?><h4 class="text-center" class="font-weight-light"> Noticias que le pueden interesar</h4><?php
                }
                ?>
                <?php
                    if($moreNews){
                        foreach($moreNews as $news){
                            $getImg = $query->getImageOne($news['id_noticia']);
                            if($getImg){
                                $resImg = $getImg->fetch();
                                $img  = "../".$resImg['archivo'];
                            }else{
                                $img  = "https://programacion.net/files/article/20160819020822_image-not-found.png";
                            }
                            ?>
                <div class='img clear'>
                    <img src="<?php echo $img;  ?>" alt="Imágen no disponible" class="sec-noti-img"> 
                    <div class="info">
                    <h4><a href="<?php echo $news['id_noticia']; ?>" class="enlace-not"><?php echo $news['titulo']; ?></a></h4>
                    <p><?php echo $news['descripcion']; ?></p>
                    </div>
                </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </section>
    </div>
    <br>
    <br>
    <footer>
            <div class="footer-container">
                <div class="footer-main">
                    <div class="footer-columna1">
                        <a href="index.php"><img src="../img/comite.png" class="img-fluid"
                            alt="Responsive image"></a>
                    </div>

                    <div class="footer-columna">
                        <h3><strong>Contáctanos</strong></h3>
                        <h6><em>Prolongación de la 1 sur No. 1101 San Pablo Tepetzingo C.P. 75859 Tehuacán, Puebla <br>
                            Tel: 01(238) 3803100 <br>
                            Email: informacion@uttehuacan.edu.mx</em></h6>
                    </div>

                    <div class="footer-columna">
                        <h3><strong>Redes sociales</strong></h3>
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">
                                <a href="#"><img src="../iconos/facebook.png" class="rounded mx-auto d-block" class="img-fluid"
                                alt="Responsive image"></a>
                            </div>
                            <div class="col-md-3">
                                <a href="#"><img src="../iconos/youtube.png" class="img-fluid" alt="Responsive image"></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>