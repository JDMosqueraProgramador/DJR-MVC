<?php

require_once '../../modelo/conexionbd.php';
require_once '../../modelo/jugadoresModel.php';

if(isset($_POST['editar']) && !empty($_POST['editar'])){
    $id_equipo = $_POST['editar'];

    if(isset($_POST['elimJug']) && !empty($_POST['elimJug'])){
        $jugadoresModel->deleteJugador($_POST['elimJug']);
    }

    if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellidos']) &&!empty($_POST['apellidos']) && isset($_POST['grado']) &&!empty($_POST['grado'])){
        $jugadoresModel->istNuevoJugador($_POST['nombre'], $_POST['apellidos'], $_POST['grado'], $id_equipo);
    }
   
    $jugadoresModel->dataJug($id_equipo);
}

?>