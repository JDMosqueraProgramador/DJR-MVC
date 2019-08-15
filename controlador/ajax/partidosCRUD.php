<?php

require '../../modelo/conexionbd.php';
require '../../modelo/partidosModel.php';

if(isset($_POST['idParEl']) && !empty($_POST['idParEl'])){
    $partidosModel->deletePartidos($_POST['idParEl']);
}


$partidosModel->dataPartidos();


?>