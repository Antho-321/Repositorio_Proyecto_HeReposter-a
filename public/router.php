<?php
if (php_sapi_name() === 'cli-server') {
    if ($_SERVER['REQUEST_URI'] === '/') {
        require 'inicio.php';
        return true;
    }
}
return false;