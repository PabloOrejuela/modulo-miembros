<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4">
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
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" value="'.$membresia->nombre.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" value="'.$membresia->cedula.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Fecha Inicio</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="fecha_inicio" value="'.$membresia->fecha_inicio.'" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Fecha Final</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" name="fecha_final" value="'.$membresia->fecha_final.'">
                                </div>';
                                echo form_hidden('idpaquete', $membresia->idpaquete);
                                echo form_hidden('total', $membresia->total);
                                echo form_hidden('idmembresias', $membresia->idmembresias);
                                echo form_hidden('tipo', $membresia->tipo);
                            
                        ?>
                        <input type="submit" name="submit" value="Actualizar" class="btn btn-outline-info" />
                    </form>
                </div>
            </div>
        </div>
    </main>

