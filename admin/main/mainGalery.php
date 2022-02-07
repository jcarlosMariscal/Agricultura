<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR GALERIA. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $galery = $query->readGalery();
?>
<div class="container">
  <h1 class="welcome text-center">Galeria</h1>
  <a class="mover-a" href="../index.php?p=galeria" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Archivo</th>
          <th scope="col">Descripción</th>
          <th scope="col">Fecha de publicación</th>
          <th scope="col">Fecha de modificación</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="create/createGalery.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php    
            if($galery){
              foreach($galery as $data){
                ?>
                  <tr>
                    <td><?php echo $data["id_foto"]; ?></td>
                    <td><?php echo $data["nom_foto"]; ?></td>
                    <td><img src="../<?php echo $data['archivo']; ?> " width="50" height="50"></img></td>
                    <td><?php echo $data["descripcion"];; ?></td>
                    <td><?php echo $data["fecha_publi"]; ?></td>
                    <td><?php echo $data["fecha_modi"]; ?></td>
                    <td><a class="boton3 btn" href='update/updateGalery.php?id_foto=<?php echo $data['id_foto']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td> <!-- EDITAR FOTO CON SU ID -->
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_foto=<?php echo $data['id_foto']?>&&table=galeria'><i class="bi bi-trash"></i>Eliminar</a></td> <!-- ELIMINAR FOTO CON SU ID -->
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