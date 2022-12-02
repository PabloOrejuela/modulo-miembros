<?php
    foreach($nombre as $i => $dato){
        echo '<option value="'.$dato['idusuarios'].'">';
        echo $dato['nombre'];
        echo '</option>';
    }
?>