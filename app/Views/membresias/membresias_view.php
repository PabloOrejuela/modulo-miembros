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
                    <?= csrf_field(); ?>
                    <table class="table table-bordered table-striped table-hover" id="table-miembros">
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Paquete</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Fecha Actual</th>
                            <th>Días</th>
                            <th>Disponible(Días)</th>
                            <th>Entradas</th>
                            <th>Entradas disponibles</th>
                            <th>Estado</th>
                            <th>Registrar Asistencia</th>
                            <th>Editar membresía</th>
                        </thead>
                    <?php 
                        //echo '<pre>'.var_export($membresias, true).'</pre>';

                        foreach ($membresias as $key => $value) {
                            echo $value->tipo;

                            $entradas_disponibles = $value->entradas - $value->asistencias;
                            
                            if ($value->tipo == 1) {
                                $fechaActual = date("Y-m-d");
                                $fecha_final = $value->fecha_final;

                                $diferenciaSegundos = strtotime($fecha_final) - strtotime($fechaActual);
                                $diferenciaDias = $diferenciaSegundos / 86400;
                                
                                //echo '<pre>'.var_export($diferenciaDias, true).'</pre>';
                                if ($diferenciaDias <= 0) {
                                    //se ha superado la fecha límite de uso
                                    $saldo = 0;
                                }else{
                                    $saldo = $diferenciaDias;
                                }
                                //echo date("Y-m-d").' : '.$value->fecha_inicio.' : '.$diff->days;
                                
                                
                            }else{
                                $saldo = $value->entradas - $value->asistencias;
                            }
                            //$saldo = $value->total - $value->asistencias;
                            echo '<tr>
                                    <td>'.$value->nombre.'</td>
                                    <td>'.$value->cedula.'</td>
                                    <td>'.$value->idpaquete.'</td>
                                    <td>'.$value->fecha_inicio.'</td>
                                    <td>'.$value->fecha_final.'</td>
                                    <td>'.date("Y-m-d").'</td>';
                            echo '<td style="text-align:center;">'.$value->dias.'</td>';
                                    //echo $value->tipo;
                            
                            if ($saldo <= ($value->asistencias /3) ){
                                echo '<td style="text-align:center;color:red;">'.$saldo.'</td>';
                            }else{
                                echo '<td style="text-align:center;">'.$saldo.'</td>';
                            }
                                    
                            echo '<td style="text-align:center;">'.$value->entradas.'</td>';
                            echo '<td style="text-align:center;">'.$saldo.'</td>';          
                            
                                
                                if ($value->status == 1 && $saldo > 0) {
                                    echo '<td>ACTIVA</td>';
                                    echo '<td style="text-align:center;">
                                            <a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" 
                                                class="registro" data-bs-toggle="modal" data-bs-target="#asistenciaModal" 
                                                onClick="pasaIdmembresia('.$value->idmembresias.','. $value->entradas.');">Asistencia
                                            </a>
                                        </td>
                                    <td style="text-align:center;">
                                        <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                            <img src="'.site_url().'public/img/buttons/edit.png" >
                                        </a>
                                    </td>';
                                }else{
                                    echo '<td style="text-align:center;">CADUCADA</td><td></td>
                                    <td style="text-align:center;">
                                        <a type="button" id="btn-register" href="edit/'.$value->idmembresias.'" class="edit">
                                            <img src="'.site_url().'public/img/buttons/edit.png" >
                                        </a>
                                    </td>';
                                }
                            
                            echo  '</tr>';
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

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
    function pasaIdmembresia(idmembresias, entradas){
        $('#idmembresias').val(idmembresias);
        $('#disponible').val(entradas);
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
        $('#asistenciaModal').hide();
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
                //location.reload();
            },
            success: function (data) {
                //location.reload();
            }
        });
    }
</script>

