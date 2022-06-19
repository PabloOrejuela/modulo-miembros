<div class="container" style="width:400px;">
        
    <form action="<?php echo site_url().'transfer-membership';?>" method="post">
        <?= csrf_field() ?>
        <h4><?= esc($title) ?></h4>
        <?php 
            //echo '<pre>'.var_export($membresia, true).'</pre>';
            echo '<div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="'.$membresia->nombre.'" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="'.$membresia->cedula.'" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Paquete</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="fecha_inicio" value="'.$membresia->fecha_inicio.'" readonly>
                </div>
                <br/>';
                echo form_hidden('idmembresias', $membresia->idmembresias);
        ?>
</div>
<div class="container" style="width:600px;">
        <table class="table table-bordered table-striped table-hover" id="table-transfer" style="width:480px;">
            <thead>
                <th>Nombre</th>
                <th>Cédula</th>
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
                                <a type="button" id="btn-register" href="'.site_url().'membership/'.$membresia->idmembresias.'/newmember'.$value->idmiembros.'" class="transfer"></a>
                            </td>
                        </tr>';
                }
                
            ?>
            
        </table>
        <p><td><?= session('errors.idmiembros');?></td></p>
        <input type="submit" name="submit" value="Transferir" class="btn btn-outline-info" />
    </form>
</div>
<script>
    $('#table-transfer').DataTable( {
        paging: true ,
        "lengthMenu": [ 3 ],
        language: {
            processing:     "Procesamiento en curso...",
            search:         "Buscar:",
            lengthMenu:     "Listar _MENU_ filas",
            info:           "_START_ a _END_ de _TOTAL_ registros",
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

