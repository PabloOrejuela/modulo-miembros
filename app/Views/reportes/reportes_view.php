<div class="container">
    <h4><?= esc($title); ?></h4>
    <?= csrf_field(); ?>

    <a type="button" id="btn-register" href="<?php echo site_url(); ?>pruebaPDF" class="edit">PDF</a>
</div>

