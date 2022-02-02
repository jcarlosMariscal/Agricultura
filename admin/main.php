<?php include "../head.php"; ?>
<body class="b">
<header>
<nav>
        <div class="container">
        <div class="row">
        <div class="col-sm-3">
                <div class="logo">
                <a href="index.php"> <img src="comite_nacional_agro.png" alt=""></a>
                </div>
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                <div class="enlaces uno" id="enlaces">
                    <a class="btn btn-outline-success" href="cerrar.php">Cerrar Sesión</a>
                    </div>
                </div>
                </div>
                </div>
            </nav>
    </header>

    <div class="container text-success text-center">
                    <h1>BIENVENIDO</h1>
            </div>
            <div class="container text-success text-center">
                    <h2 class="text-left">Hola usuario , seleccione la página que desea modificar:</h2>
            </div>
    <br>
    <br>

    <div class="contenedor">
      <a href="indexGal.php" id="caja" style="text-decoration:none;">
          <div class="color1">
              <h1 class="">Galeria</h1>
          </div>
      </a> 
      <a href="indexDoc.php" id="caja" style="text-decoration:none;">
        <!-- <div class="color2"> -->
            <h1 class="">Documentos</h1>
        <!-- </div> -->
      </a> 
    <a href="indexNoti.php" id="caja" style="text-decoration:none;">
         <div class="color3" >
          <h1 class="">Noticias</h1>
        </div>
     </a>
    <a href="index.inc.php" id="caja" style="text-decoration:none;">
        <div class="color4" >
             <h1 class="">Directorio</h1>
         </div>
    </a>   
    </div>
    <br>
    <br>
            <div class="container text-success text-center">
                    <h2 class="text-left">Modifique el contenido de estás páginas: </h2>
            </div>
            <br>
            <br>
            <div class="contenedor">
                <a href="galModiGal.php" id="caja" style="text-decoration:none;">
                    <div class="color1">
                        <h1 class="">Modificar Galeria</h1>
                    </div>
                </a> 
                <a href="notiModNoti.php" id="caja" style="text-decoration:none;">
                    <div class="color2">
                        <h1 class="">Modificar Noticia</h1>
                    </div>
                </a> 
                <a href="inicios.php" id="caja" style="text-decoration:none;">
                    <div class="color3" >
                    <h1 class="">Modificar Inicio</h1>
                    </div>
                </a>
            </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>