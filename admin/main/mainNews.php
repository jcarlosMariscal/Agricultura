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
          <th scope="col">Archivo(s)</th>
          <th scope="col">Categoria</th>
          <th scope="col">Fecha</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="create/createNews.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                    <td>
                      <?php
                        $validate = $query->searchImageNews($data['id_noticia']);
                        if($validate === 0){
                          ?><a href="create/addImageNews.php?id_noticia=<?php echo $data["id_noticia"]; ?>">Seleccionar</a><?php
                        }else{
                          $image = $query->getImage($data['id_noticia']);
                          if($image){
                            foreach($image as $img){
                              ?><a target="_blank" href="../<?php echo $img['archivo']; ?>">Ver Imagen</a> <br><?php
                            }
                          }
                        }
                      ?>
                    </td>
                    <td>
                      <?php 
                        $category = $query->readCategoryID($data["categoria"]);
                        if($category){
                          $result = $category->fetch();
                          echo $result['categoria'];
                        }
                      ?>
                    </td>
                    <td><?php echo $data["fecha"]; ?></td>
                    <td><a class="boton3 btn" href='update/updateNews.php?id_noticia=<?php echo $data['id_noticia']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td>
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_noticia=<?php echo $data['id_noticia']?>&&table=noticia'><i class="bi bi-trash"></i>Eliminar</a></td>
                    <td><a class="boton3 btn" href='#'><i class="bi bi-card-image"></i>Add</a></td>
                    <td><a class="boton3 btn" href='#'><i class="bi bi-card-image"></i>Del</a></td>
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