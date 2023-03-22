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
                <form action="<?php echo site_url().'actualizar-user';?>" method="post">
                    <?= csrf_field(); ?>
                    <?php
                    
                        if (isset($usuario) && $usuario != NULL) {
                            
                                echo '
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="FormControlInput" value="'.$usuario->nombre.'" required placeholder="nombre">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="num_documento" class="form-label">No. de Documento:</label>
                                    <input type="text" class="form-control" name="num_documento" id="FormControlInput" value="'.$usuario->num_documento.'" required placeholder="CI">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="user" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="user" id="FormControlInput" value="'.$usuario->user.'" required placeholder="CI">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" name="password" id="FormControlInput" value="" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="FormControlInput" value="'.$usuario->telefono.'" required placeholder="teléfono">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="FormControlInput" value="'.$usuario->email.'" required placeholder="jdoe@email.com">
                                </div>';
                            echo '<div class="mb-3">
                                <label for="idroles" class="form-label">Rol del usuario:</label>
                                <select class="form-select" aria-label="Default select example" name="idrol">
                                    <option value="0">Elija un rol</option>';
                                    
                                        foreach ($roles as $key => $rol) {
                                            if ($rol->idrol == $usuario->idrol) {
                                                echo '<option value="'.$rol->idrol.'" selected>'.$rol->rol.'</option>';
                                            }else{
                                                echo '<option value="'.$rol->idrol.'">'.$rol->rol.'</option>';
                                            }
                                            
                                        }
                                    
                            echo '</select>
                            </div>
                            <p>'.session('errors.idroles').'</p>';
                            }
                            echo form_hidden('idusuarios', $usuario->idusuarios);
                    ?>
                    
                    <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
                </form>
            </div>
        </div>
    </div>
</main>