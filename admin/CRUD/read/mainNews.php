<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR NOTICIAS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  $host= $_SERVER["HTTP_HOST"];
  $url= $_SERVER["REQUEST_URI"];
  if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/mainNews.php"){
      header("Location: ../../main.php");
  }
  require "Read.php";
  $query = new Read();
  $news = $query->readNews();
  $category = $query->readCategory();
  $url = "http://".$_SERVER['HTTP_HOST']."/Projects/Agricultura/noticias.php";
?>
<div class="container main">
  <h1 class="welcome text-center">Noticias</h1>
  <p class="text-center"><?php 
    if($category->rowCount() === 0){
      echo "Antes de agregar una noticia tiene que agregar una categoria. <a href='CRUD/create/createCategory.php'>Agregar</a>";
    }?>
  </p>
  <a class="mover-a" href="<?php echo $url; ?>" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table ">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col" style="width:400px">Titulo</th>
          <th scope="col">Archivo(s)</th>
          <th scope="col">Categoria</th>
          <!-- <th scope="col">TXT</th> -->
          <th scope="col">Fecha</th>
          <!-- <th scope="col"></th> -->
          <th scope="col"><a class="boton3 btn" href="CRUD/create/createNews.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                          ?><a href="CRUD/create/addImageNews.php?id_noticia=<?php echo $data["id_noticia"]; ?>">Seleccionar</a><?php
                        }else{
                          $image = $query->getImage($data['id_noticia']);
                          if($image){
                            foreach($image as $img){
                              ?><a target="_blank" href="../<?php echo $img['archivo']; ?>" style="color:#47874a">Ver Imagen</a> <br><?php
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
                    <!-- <td><?php echo $data["texto"]; ?></td> -->
                    <td><?php echo $data["fecha"]; ?></td>
                    <td><a href="CRUD/update/updateNews.php?id_noticia=<?php echo $data['id_noticia'];?>" class="update bi bi-pencil-square boton3 btn"> Editar</a></td>
                    <td><a class="deleteNews delete bi bi-trash boton3 btn"> Eliminar</a></td>
                    <td><a class="boton3 btn" href='CRUD/update/modImageNews.php?id_noticia=<?php echo $data['id_noticia']?>"'><i class="bi bi-images"></i> Image (s)</a></td>
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
<script src="js/delete.js" type="module"></script>
