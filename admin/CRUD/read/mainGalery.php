<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR GALERIA. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  $host= $_SERVER["HTTP_HOST"];
  $url= $_SERVER["REQUEST_URI"];
  if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/mainGalery.php"){
      header("Location: ../../index.php");
  }
  require "Read.php";
  $query = new Read();
  $galery = $query->readGalery();
  $url = "http://".$_SERVER['HTTP_HOST']."/Projects/Agricultura/galeria.php";
?>
<div class="container main">
  <h1 class="welcome text-center">Galeria</h1>
  <a class="mover-a" href="<?php echo $url; ?>" target="_blank">Viualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Archivo</th>
          <th scope="col">Descripción</th>
          <th scope="col">F. Publicación</th>
          <th scope="col">F. Modificación</th>
          <!-- <th scope="col"></th> -->
          <th scope="col"><a class="boton3 btn" href="CRUD/create/createGalery.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                    <td><a href="CRUD/update/updateGalery.php?id_foto=<?php echo $data['id_foto'];?>" class="update bi bi-pencil-square boton3 btn"> Editar</a></td>
                    <td><a class="deleteGal delete bi bi-trash boton3 btn"> Eliminar</a></td>
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
<!-- <script src="../js/sendDataUpdate.js" type="module"></script> -->
<script src="js/delete.js" type="module"></script>