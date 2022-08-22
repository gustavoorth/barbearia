<?php
    session_start();
    session_destroy();
    header('Location: /elsalvador/index.php');
    exit();
?>