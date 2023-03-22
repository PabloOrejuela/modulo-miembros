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
                    <?= session()->getFlashdata('error') ?>
                    <?= service('validation')->listErrors() ?>
                        
                    <form action="<?php echo site_url().'update_date';?>" method="post">
                        <?= csrf_field() ?>
                        <h4><?= esc($title) ?></h4>
                        <?php 
                            // echo '<pre>'.var_export($membresia, true).'</pre>';
                            echo '<div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" value="'.$membresia->nombre.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="num_documento" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="num_documento" value="'.$membresia->num_documento.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="'.$membresia->fecha_inicio.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_final" class="form-label">Fecha Final</label>
                                    <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="'.$membresia->fecha_final.'">
                                </div>
                                <div class="mb-3">
                                    <label for="observacion" class="form-label">Observaciones:</label>
                                    <textarea class="form-control" name="observacion" placeholder="Escriba una observación aquí" ></textarea>
                                </div>';
                                //echo form_hidden('idpaquete', $membresia->idpaquete);
                                //echo form_hidden('total', $membresia->total);
                                echo form_hidden('idmembresias', $membresia->idmembresias);
                                echo form_hidden('idmiembros', $membresia->idmiembros);
                                echo form_hidden('idtipomovimiento', 1);
                            
                        ?>
                        <input type="submit" name="submit" value="Actualizar" class="btn btn-outline-info" />
                    </form>
                </div>
            </div>
        </div>
    </main>

