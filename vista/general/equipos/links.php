<?php 

$linksStyles = ['css/equipos.css']; 

$menuActivate = [
    'numberMenu' => 2,
    'numberLink' => 2
];

if(isset($_GET['equipo'])){
    $nombrePagina = $_GET['equipo'];
}else{
    $nombrePagina = "Equipos";
}


?>