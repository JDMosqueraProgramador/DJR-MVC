<?php require_once 'modelo/equiposModel.php' ?>
<div class="nuev-prog" id="nuev-progr">
        <i class="fas fa-times-circle derecha" id="close-ventana"></i>
        <fieldset>
            <!-- Form - Crear nuevo partido -->
            <form method="post" id="form-ev" action="editar/editar-partidos/agg-partido.isrt.php">
                <h2>Crear Partido</h2><br>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="" style="display:none">
                <span id="ver_fecha"></span><br><br><br>
                <h3>Encuentro entre</h3><br>
                <select name="equipo1">
                    <?php
                    $equiposConsult = $equiposModel->dataEquipo();
                    $equiposConsult2 = $equiposModel->dataEquipo();

                    if($equiposConsult->rowCount() > 0){
                        while($equipo1 = $equiposConsult->fetch()){
                            echo "<option value='".$equipo1['id_equipo']."'>" .$equipo1['nombreEquipo'] . "</option>";
                        }
                    }
                    
                    ?>
                </select>
                vs
                <select name="equipo2">
                    <?php
                    if($equiposConsult2->rowCount() > 0){
                        while($equipo2 = $equiposConsult2->fetch()){
                            echo "<option value='".$equipo2['id_equipo']."'>" .$equipo2['nombreEquipo'] . "</option>";
                        }
                    }
                    
                    ?>
                    </select>
                <br><br>
                <input type="submit" value="crear" class="btn btn-large">
            </form>
        </fieldset>
    </div>

    <div id="edit_partido" class='nuev-prog'>
        <i class="fas fa-times-circle derecha" id="close-ventEdit"></i>
        <fieldset>
        <!-- Form - editar partido -->
            <form action="" method="post">
                <h2>Editar partido</h2><br>
                <label for="nuevafecha">Fecha:</label>
                <input type="date" name="nuevafecha"><br><br>
                <h3>Encuentro entre</h3><br>
                <div>
                    <div id='localMod'></div><vs>vs</vs><div id='visitaMod'></div><br><br>
                </div>
                <input type="submit" value="editar">
            </form>
        </fieldset>
    </div>