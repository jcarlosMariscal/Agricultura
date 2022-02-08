<!-- PÁGINA PRINCIPAL DEL ADMINISTRADOR PARA MOSTRAR DOCUMENTOS. OFRECE OPCIONES PARA AGREGAR, EDITAR Y ELIMINAR REGISTROS -->
<?php
  require "Read.php";
  $query = new Read();
  $documents = $query->readDocuments();
?>
<div class="container">
  <h1 class="welcome text-center">Documentos</h1>
  <a class="mover-a" href="../index.php?p=publicos" target="_blank">Visualizar</a>
  <br><br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Archivo</th>
          <th scope="col">Privacidad</th>
          <th scope="col">Fecha</th>
          <th scope="col"></th>
          <th scope="col"><a class="boton3 btn" href="create/createDocument.php"><i class="bi bi-plus-lg"></i>Agregar</a></th>
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
                    <td><a class="boton3 btn" href='update/updateDocuments.php?id_documento=<?php echo $data['id_documento']?>"'><i class="bi bi-pencil-square"></i>Editar</a></td>
                    <td><a class="boton3 btn" href='delete/receivedData.php?id_documento=<?php echo $data['id_documento']?>&&table=documento'><i class="bi bi-trash"></i>Eliminar</a></td>
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