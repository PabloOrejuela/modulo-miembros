<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4 col-md-6">
                <div class="card-header">
                    <i class="fa-solid fa-user-pen"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">

                <?= session()->getFlashdata('error') ?>
                <?= service('validation')->listErrors() ?>
                <form action="<?php echo site_url().'actualizar';?>" method="post">
                    <?= csrf_field(); ?>
                    <?php
                    
                        if (isset($datos) && $datos != NULL) {
                            
                                echo '
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="FormControlInput" value="'.$datos->nombre.'" required placeholder="nombre">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="num_documento" class="form-label">Cédula:</label>
                                    <input type="text" class="form-control" name="num_documento" id="num_documento" value="'.$datos->num_documento.'" required placeholder="CI">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="'.$datos->fecha_nacimiento.'" placeholder="Fecha de Nacimiento">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="'.$datos->telefono.'" required placeholder="teléfono">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" value="'.$datos->email.'" required placeholder="jdoe@email.com">
                                </div>';
                            }
                            echo form_hidden('idmiembros', $datos->idmiembros);
                    ?>
                    
                    <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
                </form>
            </div>
        </div>
    </div>
</main>