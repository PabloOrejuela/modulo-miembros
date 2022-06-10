<div class="container">

    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <form action="<?php echo site_url().'membresias/insert';?>" method="post">
        <?= csrf_field() ?>
        <h2><?= esc($title) ?></h2>
        <div class="mb-3">
            <label for="nombre" class="form-label">Miembro:</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Seleccione un miembro</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example">
                <option selected>Seleccione una membresía</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
    </form>
</div>