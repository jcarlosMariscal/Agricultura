<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR NOTICIAS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $news = $query->readNews();
?>
<div class="container">
  <h1 class="welcome text-center">Noticias</h1>
  <a class="mover-a" href="../index.php?p=noticias" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col">Archivo</th>
          <th scope="col">Categoria</th>
          <th scope="col">Fecha</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="create/createGalery.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php    
            if($news){
              foreach($news as $data){
                ?>
                  <tr>
                    <td><?php echo $data["id_noticia"]; ?></td>
                    <td><?php echo $data["titulo"]; ?></td>
                    <td><?php echo $data["archivo"];; ?></td>
                    <td><?php echo $data["categoria"]; ?></td>
                    <td><?php echo $data["fecha"]; ?></td>
                    <td><a class="boton3 btn" href='update/updateGalery.php?id_noticia=<?php echo $data['id_noticia']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td>
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_noticia=<?php echo $data['id_noticia']?>&&table=noticia'><i class="bi bi-trash"></i>Eliminar</a></td>
                  </tr>
                <?php
              }
            }
          ?>
        </tr>
      </tbody>
    </table>
  </div>
  <br>
</div>