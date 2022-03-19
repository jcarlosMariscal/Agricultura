<?php 
    include  "../template/head.php";
    include "../template/header.php";
    require "Read.php";
    $query = new Read;
    $directory = $query->readDirectory();
?>
<!-------------------------------Body------------------------------------------------------------>
<div class="container bg">
  <br>
  <h2 class="text-center" class="font-weight-light"> DIRECTORIO </h2>
  <hr>
  <table class="table table-bordered table-light">
    <thead>
      <?php if($directory->rowCount()>=1){ ?>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Estado</th>
        <th scope="col">Carrera</th>
        <th scope="col">Correo Electrónico</th>
        <th scope="col">Telefono</th>
      </tr>
      <?php
          foreach($directory as $data){
            ?>
        <tr> 
          <td><a href="<?php echo $data['url'];?>"><?php echo $data['nombre'];?></a></td>
          <td><?php echo $data['estado'];?></td>
          <td><?php echo $data['carrera'];?></td>
          <td> <a href=outlook:<nowiki><?php echo $data['email'];?></td>
          <td><?php echo $data['telefono'];?></td>
        </tr>
            <?php
          }
        }
      ?>
    </thead>
  </table>
</div>
<!------------------------------------------FinBody------------------------------>
<?php 
    include "../template/footer.php";
    include "../template/scripts.php";
?>
