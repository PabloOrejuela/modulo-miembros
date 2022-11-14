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
                    <table class="table table-bordered" style="display: inline-block;" id="datatablesSimple">
                    <thead>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Paquete</th>
                        <th>Fecha</th>
                        <th>tipo</th>
                        <th>Observación</th>
                        <th>Usuario</th>
                    </thead>
                    <?php 
                        foreach ($movimientos as $key => $value) {
                            echo '<tr>';
                            echo '<td>'.$value->Miembro.'</td>';
                            echo '<td>'.$value->Usuario.'</td>';
                            echo '<td>'.$value->paquete.'</td>';
                            echo '<td>'.$value->fecha.'</td>';
                            echo '<td>'.$value->tipo_movimiento.'</td>';
                            echo '<td>'.$value->observacion.'</td>';
                            echo '<td>'.$value->Usuario.'</td>';

                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
