<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR CATEGORIAS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/mainCategory.php"){
    header("Location: ../../main.php");
}
  require "Read.php";
  $query = new Read();
  $category = $query->readCategory();
?>
<div class="container main">
  <h1 class="welcome text-center">Categoria</h1>
  <!-- <a class="mover-a" href="../index.php?p=noticias" target="_blank">Visualizar</a> -->
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Categoria</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="CRUD/create/createCategory.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php    
            if($category){
              foreach($category as $data){
                ?>
                  <tr>
                    <td><?php echo $data["id_categoria"]; ?></td>
                    <td><?php echo $data["categoria"]; ?></td>
                    <td><a href="CRUD/update/updateCategory.php?id_categoria=<?php echo $data['id_categoria'];?>" class="update bi bi-pencil-square boton3 btn"> Editar</a></td>
                    <td><a class="deleteCat delete bi bi-trash boton3 btn"> Eliminar</a></td>
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