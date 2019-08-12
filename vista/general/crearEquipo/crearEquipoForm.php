<?php

require_once 'controlador/functions.php';

?>
<fieldset>
    <form action="controlador/nuevoEquipoCompleto.php" method="post" enctype="multipart/form-data" id="regForm" onsubmit="return val_nombre_e()">
        <div class="row sesion1">
            <div class="col-a5 parrafo">
                <img src="assets/imagenes/jesusrey.jpg" width="100px" class="izquierda circleClass"><p>
                Ahora que te has registrado como estudiante, el compromiso con la institución y de todo su personal es hacer cumplir las reglas al participar del torneo interclases llevado a cabo este año escolar. Para continuar con la inscripción, llena los campos requeridos de información general de tu equipo y comienza a vivir esta experiencia en la institución.
                </p>
            </div>

            <div class="col-a7 row">
                <div class="col-c6">

                    <div class="inputBox" onchange="formL(2, 0)">
                        <input type="text" name="nombreEquipo" id="nomEquipo">
                        <label for="nombreEquipo">Ingresa el nombre del equipo</label>
                    </div>
                </div>
                <hr style=" border: solid 1px #450797">
                <div class="col-c5">
                    <label for="escudo" id="labes">Ahora, agrega un escudo para distinguir a tu equipo <br>
                        <i class="fas fa-image"></i>
                    </label>
                    <input type="file" name="escudo" id="escudo" style="display:none;" accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>
        </div>

        <section>

            <p> Ingresa los datos de los jugadores de tu equipo:</p>
            <div class="row">

            <div class="col-b6">
                
                <table class="jug-eq" id="inp_jugadores">
                    <thead><tr><td>#</td><td>Nombre</td><td>Apellidos</td><td>Grado</td><td><i class="fas fa-hand-paper"></i></td></tr></thead>
                    <tbody>

                    <tr>
                    <!-- Capitan del equipo -->
                        <td>1</td>
                        <td><input type="text" name="nombre1" value="<?php echo segF($_SESSION['nombrej']) ?>"></td>
                        <td><input type="text" name="apellidos1" value="<?php echo segF($_SESSION['apellidosj']) ?>"></td>
                        <td><input type="text" name="grado1" value="<?php echo segF($_SESSION['gradoj']) ?>" class="grado"></td>
                        <td><input type='radio' name='portero' value="1"></td>
                    </tr>
                        
                    <?php
                    
                    // Campos para demás jugadores
                    for($i = 2; $i <= $cont_inputs; $i++){
                        echo "<tr><td class='secAr'>" .$i. "</td>
                        <td><input type='text' name='nombre" .$i. "'></td> 
                        <td><input type='text' name='apellidos" .$i. "'></td> 
                        <td><input type='text' name='grado" . $i . "' class='grado' value='".$_SESSION['gradoj']."'></td>
                        <td><input type='radio' name='portero' value='$i'></td>
                        </tr>";  
                    } 

                    ?>

                    </tbody>
                </table>

                <script>
                    // agregar más jugadores

                    var table = document.getElementById('inp_jugadores');

                    for(let i = 0; i < tds.length; i++){
                        tds[i].addEventListener("click", function aggarquero() {
                            tds[i].textContent = "5";
                        }); 
                        if(tds[i].textContent == "5"){
                            
                        }
                    }
                    
                
                </script>
                <br><br>
                <span> Si desea agregar mas de 7 jugadores a su equipo, haga clic en el botón:</span>
                <br><br><br>
                <a class="btn-aggjug pointer" onclick="mostrarforminputs()">Agregar jugadores</a>
                <br><br>

            </div>
            <div class="col-b6">
                <div class="terminos">
                    <input type="checkbox" name="terminos">
                    <label for="terminos" style="width:90%" id="fterminos">He leído y estado de acuerdo con el reglamento implementado por la institución</label><br><br>
                </div>
                <input type="submit" value="Registrar equipo">
            </div>
            </div>
        </section>

        </form>
</fieldset>

<script src="assets/js/validar_ce.js"></script>
<script src="assets/js/mostrarImagenSeleccionada.js"></script>
<script src="assets/js/formL.js"></script>
<script>
formL(2, 0);
</script>
