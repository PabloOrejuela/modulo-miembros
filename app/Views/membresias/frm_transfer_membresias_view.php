<div class="container">
    <h4><?= esc($title); ?></h4>
    <table class="table table-bordered table-striped table-hover" id="table-miembros">
        <thead>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Disponible</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Transferir</th>
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
                    if ($saldo <= ($value->total /3) ){
                        echo '<td style="text-align:center;color:red;">'.$saldo.'</td>';
                    }else{
                        echo '<td style="text-align:center;">'.$saldo.'</td>';
                    }
                    
                    
            echo '<td>'.$value->total.'</td>';
                    if ($value->status == 1) {
                        echo '<td>ACTIVA</td>';
                    }else{
                        echo'<td>INACTIVA</td>';
                    }
                    
                    if ($value->status == 1) {
                        echo '<td style="text-align:center;"><a type="button" id="btn-register" href="select-transfer-membership/'.$value->idmembresias.'" class="transfer"></a></td>';
                    }else{
                        echo '<td style="text-align:center;">CADUCADA</td>';
                    }
            
            echo  '</tr>';
        }
    ?>
    </table>
</div>

