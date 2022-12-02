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
                    <form action="<?php echo site_url().'usuario-insert';?>" method="post">
                        <?= csrf_field() ?>
                        <h4><?= esc($title); ?></h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="FormControlInput" value="<?= old('nombre'); ?>"  placeholder="nombre">
                        </div>
                        <p><?= session('errors.nombre');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="cedula" class="form-label">Cédula:</label>
                            <input type="text" class="form-control" name="cedula" maxlength="10" id="cedula" value="<?= old('cedula'); ?>" placeholder="CI">
                        </div>
                        <p><?= session('errors.cedula');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" maxlength="10" id="telefono" value="<?= old('telefono'); ?>" placeholder="teléfono">
                        </div>
                        <p><?= session('errors.telefono');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="cedula" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" name="user" id="user" value="<?= old('user'); ?>" placeholder="Usuario">
                        </div>
                        <p><?= session('errors.cedula');?> </p>
                        <div class="mb-3 col-md-8">
                            <label for="telefono" class="form-label">Password:</label>
                            <input type="text" class="form-control" name="password" id="user" value="<?= old('password'); ?>" placeholder="password">
                        </div>
                        <p><?= session('errors.telefono');?> </p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= old('email'); ?>"  placeholder="jdoe@email.com">
                        </div>
                        <p><?= session('errors.email');?> </p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Rol del usuario:</label>
                            <select class="form-select" aria-label="Default select example" name="idroles">
                                <option value="0">Elija un rol</option>
                                <?php 
                                    foreach ($roles as $key => $rol) {
                                        echo '<option value="'.$rol->idroles.'">'.$rol->rol.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <p><?= session('errors.idroles');?> </p>

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