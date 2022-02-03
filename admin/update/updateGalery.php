<?php 
include('../../head.php'); 
require "Update.php";
$query = new Update();
$id = $_GET['id_foto'];

$galery = $query -> readGalery($id);
if($galery){
    foreach($galery as $data){
        $nom_foto = $data['nom_foto'];
        $archivo = $data['archivo'];
        $descripcion = $data['descripcion'];
    }
}
$fecha_modi = strftime( "%Y-%m-%d %H-%M-%S");
?>
<h3>Modificar Imagen: <?php echo $nom_foto; ?></h3>
<div class="col-md-4">
    <div class="card card-body">
        <form method="POST" action="receivedData.php" enctype="multipart/form-data">
        <input type="text" name="table" value="galeria" hidden>
            <div class="row form-group">
                <div class="col-md-8">
                    <input type="hidden" name="id_foto" value="<?php echo $_GET['id_foto'] ?>" id="nombre" class="form-control bg-secondary text-white text-center">
                </div>
            </div>
		    <div class="row form-group">
                    <input type="text" name="table" value="galeria" hidden>
                    <label for="nombre" class="col-form-label col-md-4 bg-success text-white">Nombre de la Foto:</label>
                    <div class="col-md-8">
                        <input type="text" name="nom_foto" value="<?php echo $nom_foto ?>" id="nombre" class="form-control bg-secondary text-white text-center" required>
                    </div>
            </div>
                <div class="row form-group">
                    <label for="nombre" class="col-form-label col-md-4 bg-success text-white">Descripcion:</label>
                    <div class="col-md-8">
                        <input type="text" name="descripcion" value="<?php echo $descripcion; ?>" id="nombre" class="form-control bg-secondary text-white text-center">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="nombre" class="col-form-label col-md-4 bg-success text-white">Fecha Modificacion:</label>
                    <div class="col-md-8">
                        <input type="text" name="fecha_modi"  value="<?php echo $fecha_modi ?>" id="fecha_modi" class="form-control bg-secondary text-white text-center" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <input type="file" name="archivo"  value="" id="nombre" class=" text-black text-center" accept="image/*" required>
                    </div>
                </div>
				<br>
                <div class="row justify-content-center">
                <button type="submit" class="btn btn-success">AGREGAR</button>
                </div>
        </form>
    </div>
</div>