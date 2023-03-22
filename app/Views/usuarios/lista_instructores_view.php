<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4 col-md-8">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <form action="<?php echo site_url().'genera_reporte_asistencia_instructor';?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="card-body col-md-5">
                        <div class="form-control">
                            <label for="fecha_desde">Desde:</label>
                            <input type="date" class="form-control" name="fecha_desde" value="<?= old('fecha_desde'); ?>" >

                            <label for="fecha_hasta">Hasta:</label>
                            <input type="date" class="form-control" name="fecha_hasta" value="<?= old('fecha_hasta'); ?>" >
                        </div>
                        <p id="error-text"><?= session('errors.fecha_desde');?> </p>
                        <p id="error-text"><?= session('errors.fecha_hasta');?> </p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="datatablesSimple" >
                            <thead>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Reporte</th>
                            </thead>
                        <?php 
                            
                            
                            if ($instructores != null) {
                                foreach ($instructores as $key => $value) {
                                    //$last = $miembrosModel->_get_last_attend($idmembresias);
                                    echo '<tr>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->num_documento.'</td>
                                            <td style="text-align:center;">
                                                <input 
                                                    class="form-check-input mt-0" 
                                                    type="radio" value="'.$value->idusuario.'" 
                                                    aria-label="Checkbox" 
                                                    name="idusuario"
                                                    target="_blank"
                                                    value="'.old('idusuario').'"
                                                >
                                            </td>
                                        </tr>';
                                }
                            }else{
                                echo '<tr>
                                        <td colspan="3">No hay instructores registrados</td>
                                    </tr>';
                            }
                        ?>
                        </table>
                    <input type="submit" class="btn btn-outline-info" value="Ver reporte" formtarget="_blank">
                    <p id="error-text"><?= session('errors.idusuario');?> </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // @ts-nocheck
        $('#datatablesSimple').DataTable( {
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
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar la columna de manera ascendente",
                    sortDescending: ": activar para ordenar la columna de manera descendente"
                }
            }
        } );
    </script>