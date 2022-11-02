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
                    <form action="<?php echo site_url().'registra_aistencia_instructor';?>" method="post" name="form_registro" >
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Hora de inicio:</label>
                            <input type="text" class="form-control" name="hora_inicio" id="reloj" readonly  placeholder="<?= date('Y-m-d H:m:s'); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" name="cedula" id="FormControlInput" value="<?= old('cedula'); ?>"  placeholder="cedula">
                        </div>
                        <p><?= session('errors.cedula');?> </p>
                        <div class="mb-3">
                            <textarea name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                        </div>

                        <input type="submit" name="submit" value="Registrar" class="btn btn-outline-info" />
                        <?= form_hidden('idusuarios', $idusuarios); ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function mueveReloj(){
            momentoActual = new Date()
            
            //anio = momentoActual.getYear()
            mes = momentoActual.getMonth()
            dia = momentoActual.getDay()
            hora = momentoActual.getHours()
            minuto = momentoActual.getMinutes()
            segundo = momentoActual.getSeconds()

            horaImprimible = hora + " : " + minuto + " : " + segundo

            document.form_registro.reloj.value = horaImprimible
            setTimeout("mueveReloj()",1000)
        }
    </script>

