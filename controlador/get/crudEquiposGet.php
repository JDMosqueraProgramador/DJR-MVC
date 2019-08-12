<?php 

if($_GET['editar'] && !empty($_GET['editar'])){
    $id_equipo = $_GET['editar'];
    include 'modelo/conexionbd.php';
    require 'controlador/equiposController.php';
?>

<div class='editJugador' style='top: -100vh; transition: 1s'>
    <form action='' method='post'>
        <a class='derecha' onclick="classNames('editJugador')[0].style.top = '0'"><i class='fas fa-times-circle pointer'></i></a>
        <h1>Editar jugador</h1>
        <input type='text' name='nombreNuevo' id='nombreNuevo' value=''><br>
        <input type='text' name='apellidosNuevo' id='apellidosNuevo' value=''><br>
        <input type='text' name='grupoNuevo' id='grupoNuevo' value=''><br>
        <input type="hidden" name='idNuevo' id='idNuevo' value=''><br>
        <input type='submit' value='Editar Jugador' name='editar_jugador'>
    </form>
</div>

<script>

    function editarJugador(name, apellidos, grado, idE){
        id('nombreNuevo').value = name;
        id('apellidosNuevo').value = apellidos;
        id('grupoNuevo').value = grado;
        id('idNuevo').value = idE;

        classNames('editJugador')[0].style.top = '0';

    }

</script>

<form action="" method="post" style="margin-bottom: 100px">
    <h1> <img src="<?php echo "assets/".$equipos->basicsEquipos()['escudo'] ?>" width="10%" class="izquierda">Modificar equipo <img src="<?php echo "assets/".$equipos->basicsEquipos()['escudo'] ?>" width="10%" class="derecha"></h1>
    <div class="equipo-general">
        <input type="text" name="nombreEquipo" value="<?php echo $equipos->basicsEquipos()['nombreEquipo']; ?>">
    </div>
    
    <h2>Jugadores</h2> 
    <div class="inputs-jug">

        <script>
        document.addEventListener('DOMContentLoaded', crudJugadores("editar=<?php echo $id_equipo ?>"));

        function crudJugadores(send){
            ht = new XMLHttpRequest;
            ht.addEventListener('readystatechange', function(){
                if(this.readyState == 4 && this.status == 200){
                    classNames('inputs-jug')[0].innerHTML = this.responseText;
                    setTimeout(cerrarAlertAction, 5000);
                }
            });
            ht.open('POST', 'controlador/ajax/jugadoresCRUD.php');
            ht.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            ht.send(send);
        }
        
        </script>

    </div>   
    <br>
    <a id="agregar_jugador" onclick="mostrarEsaCosa()"><i class="fas fa-user-plus"></i></a>
    <br><br>
    <div class="enviar">
        <input type="submit" value="Modificar Datos" class="pointer" name="mod">
        <input type="submit" value="Modificar Datos" class="pointer" name="mod">
        <input type="submit" value="Modificar Datos" class="pointer" name="mod">
        <input type="submit" value="Modificar Datos" class="pointer" name="mod">
    </div>


</form>

<div class="agg" style=" top: -100vh;">
    <span class='derecha' style="font-size: 40px" onclick="mostrarEsaCosa()"><i class="fas fa-times-circle pointer"></i></span>
    <form action="" method="post" id='agrJug'>
        <h1>Agregar Nuevo jugador</h1>
        <input type="text" id='newName' name="nombreNuevoJugador" placeholder="Nombre del jugador"><br>
        <input type="text" id='newLast' name="apellidosNuevoJugador" placeholder="Apellidos del jugador"><br>
        <input type="text" id='newGrado' name="gradoNuevoJugador" placeholder="grado del jugador"><br>
        <input type="submit" value="Agregar" name="agrJug" >

        <script>
        
        id('agrJug').addEventListener('submit', function(e){
            e.preventDefault();
            var nombre = id('newName').value,
            apellidos = id('newLast').value,
            grado = id('newGrado').value;

            if(nombre != "" && apellidos != "" && grado != ""){
                crudJugadores("editar=<?php echo $id_equipo ?>&nombre="+nombre+"&apellidos="+apellidos+"&grado="+grado);
                mostrarEsaCosa();

            }
            
    
        });

        function mostrarEsaCosa(){
            var x = document.getElementsByClassName("agg")[0];
            if(x.style.top == "-100vh"){
                x.style.top = "0";
            }else{
                x.style.top = "-100vh";
            }
        }

        function cerrarAlertAction(){
            var alerts = classNames('alertAction');
            for(let i = 0; i < alerts.length; i++){
                alerts[i].style.opacity = "0";
                setTimeout(function(){
                    alerts[i].style.display = 'none';
                    classNames('inputs-jug')[0].removeChild(alerts[i]);
                    }, 1000)
            }
        }
        </script>
    </form>
</div> 



<?php
}

?>