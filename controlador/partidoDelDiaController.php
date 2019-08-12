<?php 

class PartidoDelDia extends BD{
    public function partidoDelDiaIndex(){
        $conn = parent::conectar();
        try{
            $fecha_hoy = date("Y-m-d");
            $partido_de_hoy = $conn->query("SELECT * FROM partidos WHERE fechaPartido = '$fecha_hoy'");
            if($partido_de_hoy->rowCount() > 0){
                while($datos_partido_hoy = $partido_de_hoy->fetch()){
                    $idEL = $datos_partido_hoy['id_equipoLocal'];
                    $idEV = $datos_partido_hoy['id_equipoVisitante'];
                    $idpartido = $datos_partido_hoy['id_partido'];
                    $equipo_l_x = $conn->query("SELECT nombreEquipo, escudo, id_equipo FROM equipos WHERE id_equipo = '$idEL'");
                    $equipo_v_x = $conn->query("SELECT nombreEquipo, escudo, id_equipo FROM equipos WHERE id_equipo = '$idEV'");
                    $equipo_l_d = $equipo_l_x->fetch();
                    $equipo_v_d = $equipo_v_x->fetch();

                    $ver_result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = $idpartido");
                    if($ver_result->rowCount() > 0){
                        $resultados_hoy = $ver_result->fetch();
                        $jug_e_l = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $equipo_l_d[2] and id_partido_g = $idpartido";

                        $jug_e_v = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $equipo_v_d[2] and id_partido_g = $idpartido";

                        $jug_e_v = $conn->query( $jug_e_v);
                        $jug_e_l = $conn->query( $jug_e_l);

                        // <!-- Resultado del día de hoy -->
                        echo "<div class='resultado-hoyi'>
                            <div class='boxEquipo primerequipo'>
                                <div class='escudos-r'><img src='<?php echo $equipo_l_d[1] ?>' alt=''></div>
                                <div class='equipoestado'><h2><?php echo $equipo_l_d[0] ?></h2></div>
                                <div class='anotadores'>
                                    <ul>";
                        
                                    if($jug_e_l->rowCount() > 0){
                                        while($anotadoresl = $jug_e_l->fetch()){
                                            echo "<li>".$anotadoresl['nombreJugador'] . " " . $anotadoresl['apellidosJugador'] . " (" . $anotadoresl['numeroGoles'].")</li>";
                                        }
                                    }
                                        
                                echo "
                                    </ul>
                                </div>
                            </div> ";
    
                            echo "<div class='resultado-h'><h1><?php echo $resultados_hoy[1] ." - ". $resultados_hoy[2] ?></h1></div>";
                            
                            echo "<div class='boxEquipo segundoequipo'>
                                <div class='escudos-r'><img src='<?php echo $equipo_v_d[1] ?>' alt=''></div>
                                <div class='equipoestado'><h2><?php echo $equipo_v_d[0] ?></h2></div>
                                <div class='anotadores'>
                                    <ul> ";
                                       
                                        if($jug_e_v->rowCount() > 0){
                                            while($anotadoresv = $jug_e_v->fetch()){
                                                echo "<li>".$anotadoresv['nombreJugador'] . " " . $anotadoresv['apellidosJugador'] . " (" . $anotadoresv['numeroGoles'].")</li>";
                                            }
                                        } 
                                        
                            echo "
                                    </ul>
                                </div>
                            </div>
    
                        </div> ";

                    }else{
                        echo "<div class='card-p'>
                            <div class='titulo'>
                                Partido de hoy
                            </div>
                            <div class='cuerpo row'>
                                <div class='col-4'>
                                    <img src='$equipo_l_d[1]' width='200px'>
                                </div>
                                <div class='col-4'>".
                                    $datos_partido_hoy['fechaPartido'] ."<br><br>
                                    <div class='vs-p'>vs</div><br>
                                    Lorem ipsum dolor sit amet
                                </div>
                                
                                <div class='col-4'>
                                    <img src='$equipo_v_d[1]' height='200px'>
                                </div>
                            </div>
                            <div class='equipos-p row'>
                                <div class='col-6'>$equipo_l_d[0] </div> <div class='col-6'> $equipo_v_d[0] </div>
                            </div>
                        </div> ";
                    }
                }
            }else{
                echo "<div class='card-p' style='position: relative; overflow: hidden;'>
                <div class='error'>No hay partidos programados el dia de hoy</div>
                </div>";
            }
        }catch(Exception $e){
            exit("ERROR PARTIDO DEL DIA:" .$e->getMessage());
        }
    }

    public function partidoYresultadosAdmin(){
        $conn = parent::conectar();
        try{
            $fecha_hoy = date("Y-m-d");
                $partido = "SELECT * FROM partidos WHERE fechaPartido = '$fecha_hoy'";
                $partido = $conn->query($partido);
                if($partido->rowCount() > 0){
                    while($ids_equipos = $partido->fetch()){
                        
                        $id_local = $ids_equipos['id_equipoLocal'];
                        $id_visita = $ids_equipos['id_equipoVisitante'];
                        $nombre_y_escudoL = "SELECT id_equipo, nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_local'";
                        $nombre_y_escudoV = "SELECT id_equipo, nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_visita'";
                        $nombre_y_escudoL = $conn->query($nombre_y_escudoL);
                        $nombre_y_escudoV = $conn->query($nombre_y_escudoV);

                        $mostrar_l = $nombre_y_escudoL->fetch();
                        $mostrar_v = $nombre_y_escudoV->fetch();

                        // verificar si el partido de este dia ya tiene resultado
                        $ver_result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = ".$ids_equipos['id_partido']."");
                        if($ver_result->rowCount() > 0){
                            $resultados = $ver_result->fetch();
                            echo "<div class='text-tt'>Resultado de partido de hoy</div>
                            <div class='btns_torneo'>
                                <div class='resultado-hoy'>
                                <img src='$mostrar_l[2]' class='izquierda' width='30px'>
                                <img src='$mostrar_v[2]' class='derecha' width='30px'>
                                
                                <span class='equipo'>$mostrar_l[1]</span> 
                                <span class='vs circulo'>$resultados[1] - $resultados[2]</span>
                                <span class='equipo'>$mostrar_v[1]</span>
                                </div>
                            </div>";
                        }else{
                            echo "<div class='btns_torneo'>
                            <div>
                                <img src='$mostrar_l[2]' class='izquierda' width='30px'>
                                <img src='$mostrar_v[2]' class='derecha' width='30px'>
                                
                                <span><?php echo $mostrar_l[1]; ?></span> 
                                <span class='vs circulo'>vs</span>
                                <span><?php echo $mostrar_v[1]; ?></span><br>
    
                                <a class='btn-admin' href='partidos.adm.php?local=$mostrar_l[0]&visita=$mostrar_v[0]'>Empezar partido de hoy</a><br>
    
                                <fecha>$fecha_hoy</fecha><br>
                            </div>
                        </div>";
                        }
                    }
                }else{
                    echo "<div class='error'>No hay partidos programados para hoy</div>";
                }
        }catch(Exception $e){
            exit("ERROR PARTIDO DEL DIA:" .$e->getMessage());
        }
    }

    public function partidosNoJugados(){
        $conn = parent::conectar();
        try{
            $fecha_hoy = date("Y-m-d");            
            $partidos_aplazar = $conn->query("SELECT id_partido, id_equipoLocal, id_equipoVisitante, fechaPartido FROM partidos WHERE fechaPartido < '$fecha_hoy' ORDER BY fechaPartido ASC");
            if($partidos_aplazar->rowCount() > 0){
                echo "<div class='text-tt'>partidos no jugados que deben ser aplazados:</div>";
                while($ids = $partidos_aplazar->fetch()){
                    $ver_par = $conn->query("SELECT * FROM resultados WHERE id_partido_res=$ids[0]");
                    if($ver_par->rowCount() <= 0){
                        $nombreLocal = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $ids[1]");
                        $nombreVisita =$conn->query( "SELECT nombreEquipo FROM equipos WHERE id_equipo = $ids[2]");

                        $nombreLocalF = $nombreLocal->fetch();
                        $nombreVisitaF = $nombreVisita->fetch();
                        echo "<div class='partido-aplazar'>
                        <span class='equipo'>{$nombreLocalF[0]}</span> <vs class='vs circulo'>vs</vs><span class='equipo'> {$nombreVisitaF[0]} </span>
                        <fecha>{$ids[3]}</fecha>
                        </div>";
                    }
                }
                
            }

        }catch(Exception $e){
            
        }
    }
}

$partidoDelDia = new PartidoDelDia;



