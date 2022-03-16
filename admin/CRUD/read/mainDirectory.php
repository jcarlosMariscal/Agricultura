<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR EL DIRECTORIO. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/mainDirectory.php"){
    header("Location: ../../main.php");
}
  $recibido = (int) filter_var($url, FILTER_SANITIZE_NUMBER_INT); 
  if($recibido === 0) $recibido=1;
  $rango = 2;
  require "Read.php";
  $query = new Read();
  $directory = $query->readDirectory($recibido,$rango);
?>
<div class="container main">
  <h1 class="welcome text-center">Directorio</h1>
  <a class="mover-a" href="../directorio" target="_blank">Visualizar</a>
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
                    <td><a href="#"><?php echo $data["email"]; ?></a></td>
                    <td><?php echo $data["telefono"]; ?></td>
                    <td><a href="CRUD/update/updateDirectory.php?id_directorio=<?php echo $data['id_directorio'];?>" class="update bi bi-pencil-square boton3 btn"> Editar</a></td>
                    <td><a class="deleteDir delete bi bi-trash boton3 btn"></i> Eliminar</a></a></td>
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
  <?php
    $paginador = $query ->paginador("id_directorio","directorio",$recibido,$rango);
    $section = "directorio";
    require "helper/paginador.php";
  ?>
</div>
<script src="js/delete.js" type="module"></script>