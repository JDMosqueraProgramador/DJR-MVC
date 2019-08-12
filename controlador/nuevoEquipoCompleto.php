<?php 
session_start();

require '../modelo/conexionbd.php';
require_once 'functions.php';

require '../modelo/equiposModel.php';
require '../modelo/capitanesModel.php';
require '../modelo/jugadoresModel.php';

$equiposModel->istEquipo($_FILES['escudo']['name'], $_FILES['escudo']['tmp_name'], $_POST['nombreEquipo']);

$capitanesModel->istCapitan();
$jugadoresModel->istJugadores();
$capitanesModel->executeIstCap();

header("location:../equipos.php?equipo=".$_POST['nombreEquipo']);


// require '../modelo/capitanesModel.php';


?>