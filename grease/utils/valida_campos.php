<?php
function valida_campos($campo) {
    if (isset($campo) && !empty($campo)) {
        return true;
    } else {
        return false;
    }
}

?>