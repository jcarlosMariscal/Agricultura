<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR DOCUMENTOS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
if("http://" . $host . $url === "http://localhost/Projects/Agricultura/admin/CRUD/read/mainDocuments.php"){
    header("Location: ../../main.php");
}
  require "Read.php";
  $query = new Read();
  $documents = $query->readDocuments();
  $url = "http://".$_SERVER['HTTP_HOST']."/Projects/Agricultura/publicos.php";
?>
<div class="container main">
  <h1 class="welcome text-center">Documentos</h1>
  <a class="mover-a" href="<?php echo $url; ?>" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Archivo</th>
          <th scope="col">Privacidad</th>
          <th scope="col">Fecha</th>
          <!-- <th scope="col"></th> -->
          <th scope="col"><a class="boton3 btn" href="CRUD/create/createDocument.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php    
            if($documents){
              foreach($documents as $data){
                ?>
                  <tr>
                    <td><?php echo $data["id_documento"]; ?></td>
                    <td><?php echo $data["nombre"]; ?></td>
                    <td><?php echo $data["descripcion"];; ?></td>
                    <td><a href="../<?php echo $data['archivo']; ?>" target="_blank">Ver</a></td>
                    <td>
                      <?php 
                      if($data["privacidad"] === 1){
                        echo "Público";
                      }else if($data["privacidad"] === 2){
                        echo "Privado";
                      }
                      ?>
                    </td>
                    <td><?php echo $data['fecha']; ?></td>
                    <td><a href="CRUD/update/updateDocuments.php?id_documento=<?php echo $data['id_documento'];?>" class="update bi bi-pencil-square boton3 btn"> Editar</a></td>
                    <td><a class="deleteDoc delete bi bi-trash boton3 btn"></i> Eliminar</a></td>
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