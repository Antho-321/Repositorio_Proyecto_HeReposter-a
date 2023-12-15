<?php
session_start();
session_destroy();
header("location: ../vistas/index.php");
exit();
?>