<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR CATEGORIAS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $category = $query->readCategory();
?>
<div class="container">
  <h1 class="welcome text-center">Categoria</h1>
  <a class="mover-a" href="../index.php?p=noticias" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Categoria</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="create/createCategory.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                    <td><a class="boton3 btn" href='update/updateCategory.php?id_categoria=<?php echo $data['id_categoria']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td> <!-- EDITAR CATEGORIA CON SU ID -->
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_categoria=<?php echo $data['id_categoria']?>&&table=categoria'><i class="bi bi-trash"></i>Eliminar</a></td> <!-- ELIMINAR CATEGORIA CON SU ID -->
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