<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>    
            <div class="card mb-4 col-md-5">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card-body">
                    
                    <form action="<?php echo site_url().'registra_aistencia_instructor';?>" method="post" name="form_registro" >
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de inicio:</label>
                            <input type="text" class="form-control" name="hora_inicio" id="reloj" readonly  placeholder="<?= date('Y-m-d H:m:s'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Instructor:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"  autocomplete="false" disabled>
                            <select id="nombre" name="nombre" class="form-control" required="required"></select>
                        </div>
                        <div id="imagen" class="mb-3">
                        </div>

                        <div class="mb-3">
                            <label for="num_documento" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" name="num_documento" id="num_documento" value="<?= old('num_documento'); ?>"  placeholder="cedula" autocomplete="false">
                        </div>
                        <p><?= session('errors.num_documento');?> </p>
                        <div class="mb-3">
                            <textarea name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                        </div>
                        <?php
                            $url = base_url();
                            echo '<script languaje="JavaScript">
                                    var varjs="'.$url.'";
                                    </script>';
                         ?> 
                        <input type="submit" name="submit" value="Registrar" class="btn btn-outline-info" disabled />
                        
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

