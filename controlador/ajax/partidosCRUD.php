<?php

require '../../modelo/conexionbd.php';
require '../../modelo/partidosModel.php';

if(isset($_POST['idParEl']) && !empty($_POST['idParEl'])){
    $partidosModel->deletePartidos($_POST['idParEl']);
}

if(isset($_POST['fecha']) && isset($_POST['local']) && isset($_POST['visita'])){
    $partidosModel->istPartido($_POST['fecha'], $_POST['local'], $_POST['visita']);
}

$partidosModel->dataPartidos();
 

?>