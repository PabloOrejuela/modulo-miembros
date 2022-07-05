<div class="container" style="width:400px;">
    <form action="<?php echo site_url().'insert';?>" method="post">
        <?= csrf_field() ?>
        <h4><?= esc($title); ?></h4>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="FormControlInput" value="<?= old('nombre'); ?>"  placeholder="nombre">
        </div>
        <p><?= session('errors.nombre');?> </p>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" class="form-control" name="cedula" maxlength="10" id="cedula" value="<?= old('cedula'); ?>" placeholder="CI">
        </div>
        <p><?= session('errors.cedula');?> </p>
        <div class="mb-3">
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

<script type="text/javascript">
    $('document').ready(function(){
        $("#telefono").ForceNumericOnly();
    });

</script>