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
                    <table class="table table-bordered" style="display: inline-block;">
                        <tr>
                            <td>Lista de miembros </td>
                            <td>
                                <a 
                                type="button" 
                                id="btn-reporte" 
                                href="<?php echo site_url(); ?>reportes/lista-miembros" 
                                class="btn" 
                                target="_blank"
                                ><img src="<?php echo site_url(); ?>public/images/buttons/report.svg" alt="You-logo" id="logo" />PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Lista de membresias </td>
                            <td>
                                <a 
                                type="button" 
                                id="btn-reporte" 
                                href="<?php echo site_url(); ?>reportes/lista-membresias" 
                                class="btn" 
                                target="_blank"
                                ><img src="<?php echo site_url(); ?>public/images/buttons/report.svg" alt="report-logo" id="logo" />PDF</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Lista de membresias </td>
                            <td>
                                <a 
                                type="button" 
                                id="btn-reporte" 
                                href="<?php echo site_url(); ?>reportes/lista-membresias" 
                                class="btn" 
                                target="_blank"
                                ><img src="<?php echo site_url(); ?>public/images/buttons/report.svg" alt="report-logo" id="logo" />PDF</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
