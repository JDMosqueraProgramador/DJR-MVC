<?php
session_start();

if(isset($_GET['local']) && !empty($_GET['local']) && isset($_GET['visita']) && !empty($_GET['visita'])){

    $id_local = $_GET['local'];
    $id_visita = $_GET['visita'];

    class PartidoResultados extends BD{
        public function aggResultadoFormLocal($id_local){

            $conn = parent::conectar();
            try{

                $equipo_l = "SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_local'";
                $equipo_l = $conn->query($equipo_l);
                $dat_equipol = $equipo_l->fetch();

                $jugL = $conn->prepare("SELECT id_jugador, nombreJugador, apellidosJugador FROM jugadores WHERE id_equipo_jug=:id"); 
                $jugL->bindParam(":id", $id_local);
                $jugL->execute();
                $jugL->bindColumn('id_jugador', $id_jugL);
                $jugL->bindColumn('nombreJugador', $nombreJugL);
                $jugL->bindColumn('apellidosJugador', $apJugL);

                $_SESSION['num_jug_local'] = 0;
                $_SESSION['id_jugL'] = [];

                echo "<strong><img src='assets/$dat_equipol[1]'><br> $dat_equipol[0] </strong>
                <ul class='instr'><li>Jugadores</li><li>Goles</li><li>Amarilla</li><li>Roja</li></ul> ";
                while($jugL->fetch()){
                    $_SESSION['id_jugL'][] = $id_jugL;
                    echo "<ul class='jug-dat'>
                        <li>$nombreJugL $apJugL</li>
                        <li><input type='number' name='goleslocal$id_jugL' class='golesLocal' value='0'></li>
                        <li><input type='checkbox' name='amarillalocal$id_jugL' value='$id_jugL' class='amarillalocal'></li>
                        <li><input type='checkbox' name='rojalocal$id_jugL' value='$id_jugL' class='rojalocal'></li>
                    </ul>";
                    
                    $_SESSION['num_jug_local']++;
                } 
            }catch(Exception $e){
                exit("ERROR EQUIPO LOCAL: ".$e->getMessage());
            }
        }

        public function aggResultadoFormVisita($id_visita){

            $conn = parent::conectar();
            try{
                $equipo_v = "SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_visita'";
                $equipo_v = $conn->query($equipo_v);
                $dat_equipov = $equipo_v->fetch();        

                $jugV = $conn->prepare("SELECT id_jugador, nombreJugador, apellidosJugador FROM jugadores WHERE id_equipo_jug=:id"); 
                $jugV->bindParam(":id", $id_visita);
                $jugV->execute();
                $jugV->bindColumn('id_jugador', $id_jugV);
                $jugV->bindColumn('nombreJugador', $nombreJugV);
                $jugV->bindColumn('apellidosJugador', $apJugV);
               
                $_SESSION['num_jug_visita'] = 0;
                $_SESSION['id_jugV'] = [];

                echo "<strong><img src='assets/$dat_equipov[1]'><br> $dat_equipov[0] </strong>
                <ul class='instr'><li>Jugadores</li><li>Goles</li><li>Amarilla</li><li>Roja</li></ul>";

                while($jugV->fetch()){
                    echo "<ul class='jug-dat'>
                        <li>$nombreJugV $apJugV</li>
                        <li><input type='number' name='golesvisita$id_jugV' class='golesVisita' value='0'></li>
                        <li><input type='checkbox' name='amarillavisita$id_jugV' value='$id_jugV' class='amarillavisita'></li>
                        <li><input type='checkbox' name='rojavisita$id_jugV' value='$id_jugV' class='rojavisita'></li>
                    </ul>";
                    
                    $_SESSION['num_jug_visita']++;
                    $_SESSION['id_jugV'][] = $id_jugV;
                }
            }catch(Exception $e){
                exit("ERROR EQUIPO VISITANTE: ".$e->getMessage());
            }
        }
    }

}

$partidoResultados = new PartidoResultados;



?>