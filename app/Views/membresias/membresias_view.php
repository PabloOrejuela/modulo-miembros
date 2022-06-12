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
            <th>Registrar Asistencia</th>
            <th>Editar membresía</th>
        </thead>
    <?php 
        //echo '<pre>'.var_export($membresias, true).'</pre>';

        foreach ($membresias as $key => $value) {
            echo '<tr>
                    <td>'.$value->nombre.'</td>
                    <td>'.$value->cedula.'</td>
                    <td>'.$value->fecha_inicio.'</td>
                    <td>'.$value->fecha_final.'</td>
                    <td style="text-align:center;">'.($value->saldo - $value->asistencias).'</td>
                    <td>'.$value->saldo.'</td>
                    <td style="text-align:center;"><a type="button" id="btn-register" href="asistencia/'.$value->idmembresias.'" class="registro"></a></td>
                    <td style="text-align:center;"><a type="button" id="btn-register" href="editar/'.$value->idmembresias.'" class="edit"></a></td>
                </tr>';
        }
    ?>
    </table>
</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#table-miembros').DataTable();
    } );
</script>

