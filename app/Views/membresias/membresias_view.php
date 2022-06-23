<div class="container">
    <h4><?= esc($title); ?></h4>
    <?= csrf_field(); ?>
    <table class="table table-bordered table-striped table-hover" id="table-miembros">
        <thead>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Total</th>
            <th>Disponible</th>
            <th>Estado</th>
            <th>Registrar Asistencia</th>
            <th>Editar membresía</th>
        </thead>
    <?php 
        //echo '<pre>'.var_export($membresias, true).'</pre>';

        foreach ($membresias as $key => $value) {
            $saldo = $value->total - $value->asistencias;
            echo '<tr>
                    <td>'.$value->nombre.'</td>
                    <td>'.$value->cedula.'</td>
                    <td>'.$value->fecha_inicio.'</td>
                    <td>'.$value->fecha_final.'</td>';
                    echo '<td style="text-align:center;">'.$value->total.'</td>';
                    if ($saldo <= ($value->total /3) ){
                        echo '<td style="text-align:center;color:red;">'.$saldo.'</td>';
                    }else{
                        echo '<td style="text-align:center;">'.$saldo.'</td>';
                    }
                    
                    
            
                    if ($value->status == 1) {
                        echo '<td>ACTIVA</td>';
                    }else{
                        echo'<td>INACTIVA</td>';
                    }
                    
                    if ($value->status == 1) {
                        echo '<td style="text-align:center;">
                                <a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" 
                                    class="registro" data-bs-toggle="modal" data-bs-target="#asistenciaModal" 
                                    onClick="pasaIdmembresia('.$value->idmembresias.','. $saldo.');">
                                </a>
                            </td>
                        <td style="text-align:center;"><a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit"></a></td>';
                    }else{
                        echo '<td style="text-align:center;">CADUCADA</td>
                        <td style="text-align:center;"><a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit"></a></td>';
                    }
            
            echo  '</tr>';
        }
    ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="asistenciaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar asistencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-asistencia">
                <?= csrf_field(); ?>
                <input type="hidden" id="idmembresias" name="idmembresias">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Disponible:</label>
                    <input type="text" class="form-control" id="disponible" name="num_asistencias" readonly>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Número de asistencias:</label>
                    <input type="text" class="form-control" id="num_asistencias" name="num_asistencias" value="1" onChange="verificaMaximo();">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onClick="ActualizaAsistencias();">Registrar</button>
        </div>
    </div>
  </div>
</div>
<script>
    function pasaIdmembresia(idmembresias, saldo){
        $('#idmembresias').val(idmembresias);
        $('#disponible').val(saldo);
    };

    function verificaMaximo(){
        var disponible = $('#disponible').val();
        if ($('#num_asistencias').val() > disponible) {
            alert("Cantidad máxima erronea, máximo permitdo: " + disponible);
            $('#num_asistencias').val(disponible);
        }
    };
    
    function ActualizaAsistencias(){
        //event.preventDefault();
        verificaMaximo();
        var formData = new FormData($("#form-asistencia")[0]);
        //$('#asistenciaModal').hide();
        $.ajax({
            data: formData,
            url:  'asistencia',
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            beforeSend: function(){
                $('#asistenciaModal').modal('hide');
            },
            success: function(response){
                
                if (response == 1) {
                    
                    location.reload();
                    
                }else{
                    console.log("Hubo un problema");
                }
            }
        });
    }
</script>

