<div class="container">
    <div><h3>Membresías</h3></div>
    <table class="table table-bordered table-striped table-hover" id="table-miembros">
        <thead>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Disponible</th>
            <th>Total</th>
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
                        echo '<td style="text-align:center;"><a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" class="registro"></a></td>
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

