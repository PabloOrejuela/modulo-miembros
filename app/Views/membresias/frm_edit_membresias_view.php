<div class="container" style="width:300px;">
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
        
    <form action="<?php echo site_url().'update_date';?>" method="post">
        <?= csrf_field() ?>
        <h2><?= esc($title) ?></h2>
        <?php 
            //echo '<pre>'.var_export($membresias, true).'</pre>';
            foreach ($membresia as $key => $value) {
                echo '<div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="'.$value->nombre.'" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="'.$value->cedula.'" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Fecha Inicio</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="'.$value->fecha_inicio.'" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Fecha Final</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" value="'.$value->fecha_final.'">
                    </div>';
                
            }
        ?>
        <input type="submit" name="submit" value="Actualizar" class="btn btn-outline-info" />
    </form>
</div>

