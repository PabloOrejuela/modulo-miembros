 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4 col-md-8">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card-body">               
                    <style>
                        
                        label{
                            margin-right: 10px;
                        }
                    </style>
                <form action="<?php echo site_url().'transfer_membership';?>" method="post">
                    <?= csrf_field(); ?>
                    <?php 
                        //echo '<pre>'.var_export($membresia, true).'</pre>';
                        
                        echo '<div class="input-group mb-3">
                                <label for="nombre" class="form-label">Nombre: </label>
                                <input type="text" class="form-control" aria-label="nombre" value="'.$membresia->nombre.'" readonly>
                                <label for="num_documento" class="form-label" style="margin-left: 20px;">No. de Documento: </label>
                                <input type="text" class="form-control" value="'.$membresia->num_documento.'" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Paquete</label>
                                <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="'.$membresia->paquete.'" readonly>
                            </div>
                            <div class="mb-3">
                                    <label for="observacion" class="form-label">Observaciones:</label>
                                    <textarea class="form-control" name="observacion" placeholder="Escriba una observación aquí" ></textarea>
                                </div>
                            <br/>';
                            echo form_hidden('idmembresias', $membresia->idmembresias);
                        ?>
                        <p id="error-text"><?= session('errors.idmiembros');?> </p>
                        <table class="table table-bordered table-striped table-hover" id="datatablesSimple" >
                            <thead>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Transferir</th>
                            </thead>
                            <?php
                                
                                foreach ($miembrosList as $key => $value) {
                                    //echo '<pre>'.var_export($value->idmiembros, true).'</pre>';
                                    //$last = $miembrosModel->_get_last_attend($idmembresias);
                                    echo '<tr>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->num_documento.'</td>
                                            <td style="text-align:center;">
                                                <input class="form-check-input mt-0" type="radio" value="'.$value->idmiembros.'" aria-label="Checkbox" name="idmiembros">
                                            </td>
                                        </tr>';
                                        
                                }
                                
                            ?>
                           
                        </table>
                        
                        <input type="submit" class="btn btn-outline-info" value="Transferir">
                    </form>
                </div>
            </div>
        </div>
    </main>

