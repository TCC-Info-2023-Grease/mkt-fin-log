<?php

/**
 * Summary of render_component
 * @param mixed $component
 * @return void
*/
function render_component($component) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . $component . '.php');
}
