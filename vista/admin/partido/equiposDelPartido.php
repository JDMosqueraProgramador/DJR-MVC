<?php

require 'controlador/get/agregarResultadoPartido.php';
?>

<header>Partido 1 fecha: <?php echo date("d M Y") ?> </header>

<form action="editar/editar-partidos/add-resultados.php?local=<?php echo $id_local ?>&visita=<?php echo $id_visita ?>" method="post" id='form-partido'>
    <div class="row">
        <div class="col-a5">
            <?php
            $partidoResultados->aggResultadoFormLocal($id_local);
            ?>
        </div>

        <div class="col-a1" style="text-align: center; ">(L) VS (V)</div>

        <div class="col-a5"> 
            <?php 
            $partidoResultados->aggResultadoFormVisita($id_visita);
            ?>
        </div>
    </div>

    <div class="row">

        <div class="totales col-a5">
            <div class="tot1">
                <strong>Total: </strong>
                <equipo><?php echo $dat_equipol[0] ?></equipo>
                <span><span id='resultL'>0</span> - <span id='resultV'>0</span></span>
                <equipo><?php echo $dat_equipov[0] ?></equipo>
            </div>
            <div class="tot2">
                <span>Jugadores con amarilla del equipo local: <span id="amL">0</span></span><br>
                <span>Jugadores con roja del equipo local: <span id="roL">0</span></span>
            </div>
            <div class="tot3">
                <span>Jugadores con amarilla del equipo visitante: <span id="amV">0</span></span><br>
                <span>Jugadores con roja del equipo visitante: <span id="roV">0</span></span>
            </div>        
        </div>

        <div class="col-a6" style='position: relative'>
            <input type="submit" value="Enviar datos del partido" class='pointer'>
        </div>
    </div>
</form>