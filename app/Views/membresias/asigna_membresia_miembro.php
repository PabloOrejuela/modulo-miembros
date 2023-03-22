<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?= esc($title); ?></h3>
                        
            <div class="card mb-4 col-md-6">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <h5>Asigna una membresía a un miembro ya registrado</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url().'asign_membresia';?>" method="post">
                        <?= 
                            csrf_field();
                            if (isset($datos) && $datos != NULL) {
                                
                                echo '
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="FormControlInput" value="'.$datos->nombre.'" required placeholder="nombre" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="num_documento" class="form-label">Cédula:</label>
                                    <input type="text" class="form-control" name="num_documento" id="FormControlInput" value="'.$datos->num_documento.'" required placeholder="CI" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="FormControlInput" value="'.$datos->telefono.'" required placeholder="teléfono" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="FormControlInput" value="'.$datos->email.'" required placeholder="jdoe@email.com" readonly>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" placeholder="Observaciones" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Observaciones</label>
                                </div>';
                            }
                            echo form_hidden('idmiembros', $datos->idmiembros);
                        ?>
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
            </div>
        </div>
    </main>

<script type="text/javascript">
    $('document').ready(function(){
        $("#telefono").ForceNumericOnly();
    });

</script>