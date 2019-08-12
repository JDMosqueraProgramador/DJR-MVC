
<?php

class Estsdisticas extends BD{

    public function goleador(){
        $conn = parent::conectar();
        try{
            $goleador = 0;
            $selectJugadores = "SELECT * FROM jugadores";
            $selectJugadores = $conn->query($selectJugadores);

            if($selectJugadores->rowCount() > 0){
                while ($id_jug = $selectJugadores->fetch()) {
                    $goles = "SELECT sum(numeroGoles) FROM goles WHERE id_jugador_g = $id_jug[0]";
                    $goles = $conn->query($goles);
                    $totalGoles = $goles->fetch();

                    if($totalGoles[0] > $goleador){
                        $equipo = $conn->query("SELECT * FROM equipos WHERE id_equipo =".$id_jug['id_equipo_jug']);
                        $dat_equipo = $equipo->fetch();
                        $goleador = $totalGoles[0];
                        echo "<div class='card'>
                        <div class='delante active-r'>
                            <div class='desempeño'>Goleador</div>
                            <div class='info'><i class='fas fa-info-circle'></i></div>
                            <div class='escudo'>
                                <img src='assets/".$dat_equipo['escudo']."'>
                                <br> <span>Juan David Mosquera</span>
                            </div>
                            <ul class='datos'>
                                <li>
                                    <div class='atributo'>Equipo </div>
                                    <div class='valor'>$dat_equipo[1]</div>
                                </li>
                                <li>
                                    <div class='atributo'>Grupo</div>
                                    <div class='valor'>$id_jug[3]</div>
                                </li>
                                <li>
                                    <div class='atributo'>Goles</div>
                                    <div class='valor'>$goleador</div>
                                </li>
                            </ul>
                        </div>
                        <div class='atras'>
                            <div class='go-back'><i class='fas fa-arrow-alt-circle-left'></i></div>
                            <ul class='datos'>
                                <li>
                                    <div class='atributo'>Equipo</div>
                                    <div class='valor'>$dat_equipo[1]</div>
                                </li>
                                <li>
                                    <div class='atributo'>Grupo</div>
                                    <div class='valor'>$id_jug[3]</div>
                                </li>
                                <li>
                                    <div class='atributo'>tarjetas</div>
                                    <div class='valor'></div>
                                </li>
                                <li>
                                    <div class='atributo'>Goles</div>
                                    <div class='valor'>$goleador</div>
                                </li>
                            </ul>
                        </div>
                    </div>";
                    }
                }
            }

        }catch(Exception $e){
            exit("ERROR GOLEADOR". $e->getMessage());
        }
    }
}

$estadisticas = new Estsdisticas;


?>