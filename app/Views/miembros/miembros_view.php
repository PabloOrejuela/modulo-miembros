<div class="container">
    <div><h3>Lista de miembros</h3></div>
    <table class="table table-bordered table-striped table-hover" id="table-miembros">
        <thead>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Ultima Asistencia</th>
            <th>Editar</th>
        </thead>
    <?php 
        //echo '<pre>'.var_export($membresias, true).'</pre>';

        foreach ($membresias as $key => $value) {
            echo '<tr>
                    <td>'.$value->nombre.'</td>
                    <td>'.$value->cedula.'</td>
                    <td>'.$value->fecha_final.'</td>
                    <td style="text-align:center;"><a type="button" id="btn-register" href="editar/'.$value->idmiembros.'" class="edit"></a></td>
                </tr>';
        }
    ?>
    </table>
</div>

