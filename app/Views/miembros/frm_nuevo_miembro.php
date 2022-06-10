<div class="container">

    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <form action="<?php echo site_url().'insert';?>" method="post">
        <?= csrf_field() ?>
        <h2><?= esc($title) ?></h2>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="FormControlInput" required placeholder="nombre">
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" class="form-control" name="cedula" id="FormControlInput" required placeholder="CI">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="FormControlInput" required placeholder="teléfono">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="FormControlInput" required placeholder="jdoe@email.com">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Membresías:</label>
            <select class="form-select" aria-label="Default select example" name="idpaquete">
                <?php 
                    foreach ($paquetes as $key => $paquete) {
                        echo '<option value="'.$paquete->idpaquete.'">'.$paquete->paquete.'</option>';
                    }
                ?>
            </select>
        </div>


        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
    </form>
</div>