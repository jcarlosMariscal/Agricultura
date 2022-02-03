<?php include('../../head.php'); ?>
<div class="col-md-4">
    <div class="card card-body">
        <form method="POST" action="receivedData.php" enctype="multipart/form-data">
		<div class="row form-group">
                    <input type="text" name="table" value="galeria" hidden>
                    <label for="nombre" class="col-form-label col-md-4 bg-success text-white">Nombre de la Foto:</label>
                    <div class="col-md-8">
                        <input type="text" name="nom_foto" value="" id="nombre" class="form-control bg-secondary text-white text-center" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="nombre" class="col-form-label col-md-4 bg-success text-white">Descripcion:</label>
                    <div class="col-md-8">
                        <input type="text" name="descripcion" value="" id="nombre" class="form-control bg-secondary text-white text-center">
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