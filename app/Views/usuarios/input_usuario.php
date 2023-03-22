<?php
    foreach($nombre as $i => $dato){
        echo '<option value="'.$dato['idusuario'].'">';
        echo $dato['nombre'];
        echo '</option>';
    }
?>