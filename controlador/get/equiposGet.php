<?php

include 'controlador/equiposController.php';

if(!isset($_GET['equipo']) || empty($_GET['equipo'])){
?>

<div class="row">
        <div class="col-a7">

            <div class="links_equipos">
                <div class="equipoBtn">
                    Equipos participantes del torneo
                </div>

                <?php

                $equipos->equiposGeneral();
            
                ?>

            </div>
        </div>
        <div class="col-a5">
        <!-- animación de rotación -->
            <div class="giro">
                <div class="circulo-l">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <img src="assets/imagenes/jesusrey.jpg">
                </div>
            </div>
        </div>
    </div>


<?php
}else{
    $equipos->equipoEnEspecifico();
}

?>

<div>
