<?php
function valida_campo($campo) {
    if (isset($campo) && !empty($campo)) {
        return true;
    } else {
        return false;
    }
}

?>