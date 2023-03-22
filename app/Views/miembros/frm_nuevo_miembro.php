<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4 col-md-6">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url().'insert';?>" method="post">
                        <?= csrf_field() ?>
                        <h4><?= esc($title); ?></h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="FormControlInput" value="<?= old('nombre'); ?>"  placeholder="nombre">
                        </div>
                        <p><?= session('errors.nombre');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="num_documento" class="form-label">No. de documento:</label>
                            <input type="text" class="form-control" name="num_documento" maxlength="10" id="num_documento" value="<?= old('num_documento'); ?>" placeholder="CI">
                        </div>
                        <p><?= session('errors.num_documento');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= old('fecha_nacimiento'); ?>" placeholder="Fecha de Nacimiento">
                        </div>
                        <p><?= session('errors.fecha_nacimiento');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" maxlength="10" id="telefono" value="<?= old('telefono'); ?>" placeholder="teléfono">
                        </div>
                        <p><?= session('errors.telefono');?> </p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= old('email'); ?>"  placeholder="jdoe@email.com">
                        </div>
                        <p><?= session('errors.email');?> </p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Membresías:</label>
                            <select class="form-select" aria-label="Default select example" name="idpaquete">
                                <option value="0">Elija un paquete</option>
                                <?php 
                                    foreach ($paquetes as $key => $paquete) {
                                        echo '<option value="'.$paquete->idpaquete.'">'.$paquete->paquete.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <p><?= session('errors.idpaquete');?> </p>

                        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
                    </form>
                </div>
            </div>
        </div>
    </main>

<script type="text/javascript">
    $('document').ready(function(){
        $("#telefono").ForceNumericOnly();
    });

</script>