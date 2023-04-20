<?php
function valida_campo($campo) {
    return isset($campo) && !empty($campo) ? true : false;
}

?>