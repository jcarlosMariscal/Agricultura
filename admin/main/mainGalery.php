<?php
// session_start();
// if (!isset($_SESSION["email"])){
//     header("Location: admin.php");
// }

require "Read.php";
$query = new Read();
$galery = $query->readGalery();
include('../head.php');
?>
 <body>
 <main class="container p-4">
  <div class="row">
    <div class="col-md-8">
	<h1>Galeria</h1>
    <a href="create/createGalery.php">Agregar</a>
      <table class="table table-bordered">
        <thead>
          <tr>
			<th><strong>#</strong></th>
			<th><strong>Nombre de la foto</strong></th>
			<th><strong>Ubicacion</strong></th>
			<th><strong>Descripcion</strong></th>
			<th><strong>Estado</strong></th>
			<th><strong>fecha_publi</strong></th>
			<th><strong>fecha_modi</strong></th>
        </thead>
        <tbody>

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
                        <td>
                        <a href="update/updateGalery.php?id_foto=<?php echo $data['id_foto']?>" class="btn btn-secondary">
                            <i class="fas fa-marker"></i>
                        </a>
                        <a href="delete/receivedData.php?id_foto=<?php echo $data['id_foto']?>&&table=galeria" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
 </body>
 </html>


 

 