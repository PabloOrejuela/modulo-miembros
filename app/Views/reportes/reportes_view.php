<div class="container">
    <h4><?= esc($title); ?></h4>
    <?= csrf_field(); ?>
    <table class="table table-bordered" style="display: inline-block;">
        <tr>
            <td>Lista de miembros </td>
            <td>
                <a 
                type="button" 
                id="btn-reporte" 
                href="<?php echo site_url(); ?>listaMiembrosPDF" 
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
                href="<?php echo site_url(); ?>listaMembresiasPDF" 
                class="btn" 
                target="_blank"
                ><img src="<?php echo site_url(); ?>public/images/buttons/report.svg" alt="You-logo" id="logo" />PDF</a>
            </td>
        </tr>
    </table>
</div>

