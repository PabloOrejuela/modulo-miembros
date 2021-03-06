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
                <style>
                    
                    label{
                        margin-right: 10px;
                    }
                </style>
                        
                    <?= csrf_field(); ?>
                    <h4><?= esc($title) ?></h4>
                    <?php 
                        //echo '<pre>'.var_export($membresia, true).'</pre>';
                        
                        echo '<div class="input-group mb-3">
                                <label for="nombre" class="form-label">Nombre: </label>
                                <input type="text" class="form-control" aria-label="nombre" value="'.$membresia->nombre.'" readonly>
                                <label for="cedula" class="form-label" style="margin-left: 20px;">Cedula: </label>
                                <input type="text" class="form-control" value="'.$membresia->cedula.'" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="paquete" class="form-label">Paquete</label>
                                <input type="text" class="form-control" id="paquete" name="fecha_inicio" value="'.$membresia->paquete.'" readonly>
                            </div>
                            <br/>';
                            echo form_hidden('idmembresias', $membresia->idmembresias);
                    ?>
                        <table class="table table-bordered table-striped table-hover" id="table-transfer">
                            <thead>
                                <th>Nombre</th>
                                <th>C??dula</th>
                                <th>Transferir</th>
                            </thead>
                            <?php
                                foreach ($miembros as $key => $value) {
                                    //echo '<pre>'.var_export($value->idmiembros, true).'</pre>';
                                    //$last = $miembrosModel->_get_last_attend($idmembresias);
                                    echo '<tr>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->cedula.'</td>
                                            <td style="text-align:center;">
                                                <a type="button" id="btn-register" href="'.site_url().'membership/'.$membresia->idmembresias.'/newmember'.$value->idmiembros.'" class="transfer">
                                                    <img src="'.site_url().'public/img/buttons/transfer.png" >
                                                </a>
                                            </td>
                                        </tr>';
                                }
                                
                            ?>
                            
                        </table>
                        <p><td><?= session('errors.idmiembros');?></td></p>
                    </form>
                </div>
            </div>
        </div>
    </main>
<script>
    $('#table-transfer').DataTable( {
        paging: true ,
        "lengthMenu": [ 3 ],
        language: {
            processing:     "Procesamiento en curso...",
            search:         "Buscar:",
            lengthMenu:     "Listar _MENU_ filas",
            info:           "_START_ al _END_ de _TOTAL_ registros",
            infoEmpty:      "0 a 0 de 0 registros",
            infoFiltered:   "",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "No hay registros para mostrar",
            emptyTable:     "Mo hay registros que coicidan",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "??ltimo"
            },
            aria: {
                sortAscending:  ": activar para ordenar la columna de manera ascendente",
                sortDescending: ": activar para ordenar la columna de manera descendente"
            }
        }
    } );

</script>

