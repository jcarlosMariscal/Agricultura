<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR EL DIRECTORIO. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $directory = $query->readDirectory();
  $url = "http://".$_SERVER['HTTP_HOST']."/Projects/Agricultura/directorio.php";
?>
<div class="container main">
  <h1 class="welcome text-center">Directorio</h1>
  <a class="mover-a" href="<?php echo $url; ?>" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Estado</th>
          <th scope="col">Carrera</th>
          <th scope="col">E-mail</th>
          <th scope="col">Teléfono</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="CRUD/create/createDirectory.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php    
            if($directory){
              foreach($directory as $data){
                ?>
                  <tr>
                    <td><?php echo $data["id_directorio"]; ?></td>
                    <td><a href="<?php echo $data['url']; ?>" target="_blank"><?php echo $data["nombre"]; ?></a></td>
                    <td><?php echo $data["estado"];; ?></td>
                    <td><?php echo $data["carrera"]; ?></td>
                    <td><?php echo $data["email"]; ?></td>
                    <td><?php echo $data["telefono"]; ?></td>
                    <td><a href="CRUD/update/updateDirectory.php?id_directorio=<?php echo $data['id_directorio'];?>" class="update bi bi-pencil-square boton3 btn">Editar</a></td>
                    <td><a class="deleteDir delete bi bi-trash boton3 btn"></i>Eliminar</a></a></td>
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