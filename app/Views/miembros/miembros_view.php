<div class="container">
    <div><h3>Lista de miembros</h3></div>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Disponible</th>
            <th>Asistencia</th>
        </thead>
    <?php 
        //echo '<pre>'.var_export($miembros, true).'</pre>';

        foreach ($membresias as $key => $value) {
            echo '<tr>
                    <td>'.$value->nombre.'</td>
                    <td>'.$value->cedula.'</td>
                    <td>'.$value->fecha_inicio.'</td>
                    <td>'.$value->fecha_final.'</td>
                    <td>'.$value->saldo.'</td>
                    <td><a href="asistencia/'.$value->idmiembros.'" class="btn btn-outline-info">Asistencia</a></td>
                </tr>';
        }
    ?>
    </table>
</div>

