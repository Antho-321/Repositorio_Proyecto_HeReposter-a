<?php
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    if ($url['path'] === '/') {
        require 'inicio.php';
        return true;
    }
}
return false;