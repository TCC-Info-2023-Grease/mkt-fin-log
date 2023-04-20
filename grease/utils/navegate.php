<?php 
function navegate($url) {
    header('Location: ' . $url);
    exit();
}