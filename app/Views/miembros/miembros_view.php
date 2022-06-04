<div class="container">
    <div><h3>Lista de miembros</h3></div>
    <?php 
        //echo '<pre>'.var_export($miembros, true).'</pre>';
        
        foreach ($miembros as $key => $value) {
            echo 'Nombre: ',$value->nombre.' <br>';
            echo 'Email: ',$value->email.'<br> ';
        }
        
        
    ?>
</div>

