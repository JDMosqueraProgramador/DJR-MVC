<?php

require '../../modelo/conexionbd.php';
require '../equiposController.php';
require '../../modelo/equiposModel.php';

if(isset($_POST['eliminar']) && !empty($_POST['eliminar'])){
    $equiposModel->deleteEquipo($_POST['eliminar']);
}

$equipos->crudEquipos();

?>