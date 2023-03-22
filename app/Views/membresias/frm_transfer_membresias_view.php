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
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Fecha Actual</th>
                            <th>Total</th>
                            <th>Disponible</th>
                            <th>Estado</th>
                            <th>Transferir</th>
                        </thead>
                    <?php 
                        //echo '<pre>'.var_export($membresias, true).'</pre>';

                        foreach ($membresias as $key => $value) {
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
                                $saldo = $value->dias - $value->asistencias;
                            }
                            echo '<tr>
                                    <td>'.$value->nombre.'</td>
                                    <td>'.$value->num_documento.'</td>
                                    <td>'.$value->fecha_inicio.'</td>
                                    <td>'.$value->fecha_final.'</td>
                                    <td>'.date("Y-m-d").'</td>';
                            echo '<td style="text-align:center;">'.$value->dias.'</td>';
                                    if ($saldo <= ($saldo /3) ){
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
                                                <a type="button" id="btn-register" href="select-transfer-membership/'.$value->idmembresias.'" class="transfer">
                                                    <img src="'.site_url().'public/img/buttons/transfer-membership.png" >
                                                </a>
                                            </td>';
                                    }else{
                                        echo '<td style="text-align:center;">CADUCADA</td>';
                                    }
                            
                            echo  '</tr>';
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

