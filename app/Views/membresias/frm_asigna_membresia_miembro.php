<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?= esc($title); ?></h3>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <h5>Asigna una membresía a un miembro ya registrado</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple" >
                        <thead>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Asigna membresía</th>
                        </thead>
                    <?php 
                        
                        

                        foreach ($miembrosList as $key => $value) {
                            //$last = $miembrosModel->_get_last_attend($idmembresias);
                            echo '<tr>
                                    <td>'.$value->nombre.'</td>
                                    <td>'.$value->num_documento.'</td>
                                    <td style="text-align:center;">
                                        <a type="button" id="btn-register" href="asigna_membresia_miembro/'.$value->idmiembros.'">
                                            <i class="fa-solid fa-user-pen"></i>   
                                        </a>
                                    </td>
                                </tr>';
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // @ts-nocheck
        $('#datatablesSimple').DataTable( {
            paging: true ,
            "lengthMenu": [ 3 ],
            language: {
                processing:     "Procesamiento en curso...",
                search:         "Buscar:",
                lengthMenu:     "Listar _MENU_ filas",
                info:           "_START_ al _END_ de _TOTAL_ registros",
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