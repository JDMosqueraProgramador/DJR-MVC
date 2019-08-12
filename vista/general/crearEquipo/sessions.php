<?php

session_start();

if(!isset($_SESSION['apellidosj']) || !isset($_SESSION['nombrej']) || !isset($_SESSION['correoj']) || !isset($_SESSION['contrj'])){
    
    echo "<script>
    alert('Primero debe registrarse como capitán');
    window.location = 'http://localhost/proyecto/crear-cuenta.php';
    </script>";

    exit;
}

$cont_inputs = 7;
?>