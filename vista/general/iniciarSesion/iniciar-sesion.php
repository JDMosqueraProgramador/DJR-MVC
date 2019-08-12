<div class="nuev-prog pag-1" id="nuev-progr">
    <i class="fas fa-times-circle derecha" id="close-ventana" onclick="venM()"></i>
    <fieldset>
        <img src="assets/imagenes/jesusrey.jpg" width="70px" height="70px" class="circulo"><br>
        <!-- <form action="iniciar-sesion.php" method="post" onsubmit="return formF()" id="iniciar-sesion"> -->
            <h2><strong> Iniciar Sesión</strong></h2><br><br>
            <div class="inputBox" onchange="return formL(0,0)">
                <input type="text" name="usuario"  id="usuario">
                <label for="usuario" id="labelf">Correo</label>
            </div>
            <div class="inputBox" onchange="return formL(1,1)">
                <input type="password" name="contraseña" id="pass">
                <label for="contraseña" id="labelp">Contraseña</label>
            </div>
            <div class="inputBox">
                    <select name="tipo" id="tipo">
                        <option value="1">Profesor</option>
                        <option value="2">Estudiante</option>
                    </select>
                </div><br>
                <input type="submit" value="Entrar" class="btn-large" id='btn-env'>
        <!-- </form> -->
    </fieldset>
</div>