<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR EL DIRECTORIO. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $directory = $query->readDirectory();
?>
<div class="container">
  <h1 class="welcome text-center">Directorio</h1>
  <a class="mover-a" href="../index.php?p=directorio" target="_blank">Visualizar</a>
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
          <th scope="col"><a class="boton3 btn" href="create/createGalery.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                    <td><?php echo $data["nombre"]; ?></td>
                    <td><?php echo $data["estado"];; ?></td>
                    <td><?php echo $data["carrera"]; ?></td>
                    <td><?php echo $data["email"]; ?></td>
                    <td><?php echo $data["telefono"]; ?></td>
                    <td><a class="boton3 btn" href='update/updateGalery.php?id_directorio=<?php echo $data['id_directorio']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td>
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_directorio=<?php echo $data['id_directorio']?>&&table=directorio'><i class="bi bi-trash"></i>Eliminar</a></td>
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