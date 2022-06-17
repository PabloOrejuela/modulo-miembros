<div class="container" style="width:300px;">
    <div><h3>Editar Membresía</h3></div>
    <form>
    <?php 
        //echo '<pre>'.var_export($membresias, true).'</pre>';
        foreach ($membresia as $key => $value) {
            echo '<div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="'.$value->nombre.'">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="'.$value->cedula.'">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fecha Inicio</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="'.$value->fecha_inicio.'">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fecha Final</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="'.$value->fecha_final.'">
                </div>';
            
        }
    ?>
        <input type="submit" name="submit" value="Guardar" class="btn btn-outline-info" />
    </form>
</div>

