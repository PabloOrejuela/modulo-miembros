<div class="container">

    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <form action="<?php echo site_url().'miembros/insert';?>" method="post">
        <?= csrf_field() ?>
        <h2><?= esc($title) ?></h2>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="FormControlInput" placeholder="nombre">
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" class="form-control" name="cedula" id="FormControlInput" placeholder="CI">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="FormControlInput" placeholder="teléfono">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="FormControlInput" placeholder="jdoe@email.com">
        </div>


        <input type="submit" name="submit" value="Guardar" class="btn btn-light" />
    </form>
</div>