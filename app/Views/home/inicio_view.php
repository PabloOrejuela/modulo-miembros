<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>    
            <div class="card mb-4 col-md-5">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card-body">
                    <?= csrf_field(); ?>
                    <h1>Bienvenidos al módulo de miembros</h1>
                </div>
            </div>
        </div>
    </main>

