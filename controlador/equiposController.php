<?php 

class Equipos extends BD{
    
    public function tablaDePosiciones(){
        $conn = parent::conectar();
        try{
            // Tabla de posiciones
            $equipos = $conn->query('SELECT * FROM equipos ORDER BY puntos DESC, nombreEquipo ASC');
            if($equipos->rowCount() > 0){
                
                $posicion = 1;
                while($dat_equipos = $equipos->fetch()){
                    $id_equipo = $dat_equipos['id_equipo'];
                    // Total de goles anotados de visitante y recibidos de local de cada equipo
                    $golesjv = "SELECT partidos.id_equipoVisitante, sum(golesVisitante) AS totalGolesV, sum(golesLocal) AS totalGolesLC FROM resultados INNER JOIN partidos ON resultados.id_partido_res = partidos.id_partido WHERE partidos.id_equipoVisitante = " .$dat_equipos['id_equipo'];

                    // Total de goles anotados de local y recibidos de visitante de cada equipo
                    $golesjl = "SELECT partidos.id_equipoLocal, sum(golesLocal) AS totalGolesL, sum(golesVisitante) AS totalGolesVC FROM resultados INNER JOIN partidos ON resultados.id_partido_res = partidos.id_partido WHERE partidos.id_equipoLocal = " .$dat_equipos['id_equipo'];

                    $golesjl = $conn->query($golesjl);
                    $golesjv = $conn->query($golesjv);

                    //Total de partidos jugados
                    $t_part_j = "SELECT count(id_resultado) FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE partidos.id_equipoLocal = $id_equipo OR partidos.id_equipoVisitante = $id_equipo";
                    $t_part_j = $conn->query($t_part_j);
                    $t_j = $t_part_j->fetch();

                    // total de victorias del equipo de Local
                    $t_victoriasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                    $t_victoriasl = $conn->query($t_victoriasl);
                    $t_vl = $t_victoriasl->fetch();

                    // total de victorias del equipo como visitante
                    $t_victoriasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                    $t_victoriasv = $conn->query($t_victoriasv);
                    $t_vv = $t_victoriasv->fetch();

                    //Numero total de victorias
                    $t_vic = $t_vl[0] + $t_vv[0];

                    // total de empates 
                    $t_empates = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_equipo OR partidos.id_equipoVisitante = $id_equipo)";
                    $t_empates = $conn->query($t_empates);
                    $t_e = $t_empates->fetch();

                    // total de derrotas del equipo de Local
                    $t_derrotasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                    $t_derrotasl = $conn->query($t_derrotasl);
                    $t_dl = $t_derrotasl->fetch();

                    // total de derrotas del equipo como visitante
                    $t_derrotasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                    $t_derrotasv = $conn->query($t_derrotasv);
                    $t_dv = $t_derrotasv->fetch();

                    // numero total de derrotas
                    $t_derr = $t_dl[0] + $t_dv[0];
                    
                    $totalgoles = 0;
                    $totalgolesc = 0;
                    if($golesjl->rowCount() > 0){
                        while($res_golesl = $golesjl->fetch()){
                            $totalgolesc += $res_golesl['totalGolesVC'];
                            $totalgoles += $res_golesl['totalGolesL'];
                        }
                    }
                    if($golesjv->rowCount() > 0){
                        while($res_golesv = $golesjv->fetch()){
                            $totalgolesc += $res_golesv['totalGolesLC'];
                            $totalgoles += $res_golesv['totalGolesV'];
                        }
                    }
                    echo "<tr>
                        <td>$posicion</td>
                        <td>".$dat_equipos['nombreEquipo']."</td>
                        <td>".$dat_equipos['puntos']."</td>
                        <td>$t_j[0]</td>
                        <td>$t_vic</td>
                        <td>$t_e[0]</td>
                        <td>$t_derr</td>
                        <td>$totalgoles</td>
                        <td>$totalgolesc</td>
                        <td>".($totalgoles-$totalgolesc)."</td>

                    </tr>";
                    $posicion++;
                }
            }else{
                echo "<tr><td colspan='10' rowspan='15'><div style='margin: 150px 0; font-size: 20px; font-weight: 700'>No hay equipos aún en el torneo</div></td></tr>";
            }
        }catch(Exception $e){
            exit("ERROR TABLA DE POSICIONES: ".$e->getMessage());
        }
    }

    public function equiposGeneral(){
        $conn = parent::conectar();
        try{
            $select_equipos = "SELECT * FROM equipos";
            $equipos = $conn->query($select_equipos);

            if($equipos->rowCount() > 0){
                while($mostrar_equipos = $equipos->fetch()){
                    
                    echo "<div class='equipoBtn'>";
                    echo "<a href='?equipo=" . $mostrar_equipos['nombreEquipo'] . "'>";
                    echo "<img src='assets/". $mostrar_equipos['escudo'] ."' class='izquierda'>";
                    echo $mostrar_equipos['nombreEquipo'];
                    echo "<img src='assets/". $mostrar_equipos['escudo']."' class='derecha'></a>";
                    echo "</div>";
                    
                }
            }else{
                echo "<div class='equipoBtn _error'>";
                echo "<span>Aún no hay equipos para mostrar</span>";
                echo "</div>";
            }
        }catch(Exception $e){
            exit("ERROR EQUIPOS: ".$e->getMessage());
        }
    }

    public function equipoEnEspecifico(){
        $conn = parent::conectar();
        try{
            $nom = htmlspecialchars($_GET['equipo']);
            $consultr = "SELECT * FROM equipos WHERE nombreEquipo='$nom'";

            $consult = $conn->query($consultr);

            // Mostrar datos de los equipos
    
            if($consult->rowCount() > 0){
                while($mostrar_estadisticas = $consult->fetch()){
                    echo "<div class='container'>
                    <div class='info-equipo container'>
                        <div class='row cabeza'>
                            <div class='col-10'>
                                <span class='nombreEquipo'>". $mostrar_estadisticas['nombreEquipo'] ."</span>
                            </div>
                            <div class='col-2'>
                                <img src='assets/".$mostrar_estadisticas['escudo']."'>
                            </div>
                        </div>
                        <div class='row'>
        
                            <div class='info-jugadores col-b6'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nombres</th><th>Apellidos</th><th>Grado</th><th>Faltas</th><th>Goles</th>
                                        </tr>
                                    </thead>
                                    <tbody>";


                                    $id = $mostrar_estadisticas['id_equipo'];
                                    $select_jugadores = "SELECT * FROM jugadores WHERE id_equipo_jug=$id";
                
                                    //  Mostrar jugadores del equipo
                                    $select_jugC = $conn->query($select_jugadores);
                                    while($mostrar_jugadores = $select_jugC->fetch()){
                                        $con_num_goles = $conn->query("SELECT sum(numeroGoles) FROM goles WHERE id_jugador_g=".$mostrar_jugadores['id_jugador']."");
                                        $num_goles = $con_num_goles->fetch();
                                        $con_sanciones = $conn->query("SELECT count(id_jugador_san) FROM sanciones WHERE id_jugador_san = ".$mostrar_jugadores['id_jugador']."");
                                        $num_sanciones = $con_sanciones->fetch();

                                        
                                        echo "   <tr>
                                        <th>". $mostrar_jugadores['nombreJugador'] ." </th>
                                        <th>". $mostrar_jugadores['apellidosJugador'] ." </th>
                                        <th>". $mostrar_jugadores['grupoJugador'] ."</th>
                                        <th> $num_sanciones[0] </th>
                                        <th> ";

                                            if(empty($num_goles[0])){
                                                echo "0";
                                            }else{
                                                echo $num_goles[0];
                                            }

                                        echo "
                                        </th>
                                    </tr>";

                                    }
                        echo " </tbody>
                        </table>
                    </div>";

                    echo "<div class='col-b6'>
                        
                        <section class='encuentros'>
                            <h1>Programación del equipo <br><span> (Año - Mes - Dia)</span></h1>";


                    // Mostrar partidos programados en los que juega el equipo
                    $fecha_hoy = date('Y-m-d');
                    $encuentro = "SELECT * FROM partidos WHERE (id_equipoLocal = $id OR id_equipoVisitante = $id) AND fechaPartido >= '$fecha_hoy' ORDER BY fechaPartido ASC";
                    $encuentroQ = $conn->query($encuentro);
                    if($encuentroQ->rowCount() > 0){
                        while($most_encuentr = $encuentroQ->fetch()){

                            $id_eq_local = $most_encuentr['id_equipoLocal'];
                            $id_eq_vist = $most_encuentr['id_equipoVisitante'];
                            $nombreLocal = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_local";
                            $nombreVisita = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_vist";
                            $nombreLocal = $conn->query($nombreLocal);
                            $nombreVisita = $conn->query($nombreVisita);
                            $nombreLocalF = $nombreLocal->fetch();
                            $nombreVisitaF = $nombreVisita->fetch();

                            echo "<d3><div>"
                                .$most_encuentr['fechaPartido'] . 
                                "</div> <div>". $nombreLocalF[0] ."<span> vs </span>". $nombreVisitaF[0]. "</div>
                                </d3>";
                        }
                    }else{
                        echo "<div class='error'>No hay encuentros programados </div>";
                    }
                    echo "</section>
                    <section>
                        <h1>Resultados</h1>";    

                        $resultados = $conn->query("SELECT partidos.id_equipoLocal,partidos.id_equipoVisitante,partidos.fechaPartido, resultados.golesLocal, resultados.golesVisitante FROM partidos inner join resultados on resultados.id_partido_res = partidos.id_partido WHERE (partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id) ORDER BY partidos.fechaPartido");

                            if($resultados->rowCount() > 0){
                                while($resul = $resultados->fetch()){
                                    $idEL = $resul['id_equipoLocal'];
                                    $idEV = $resul['id_equipoVisitante'];
                                    $equipo_l_x = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = '$idEL'");
                                    $equipo_v_x = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = '$idEV'");

                                    $nombres_p_f_l = $equipo_l_x->fetch();
                                    $nombres_p_f_v = $equipo_v_x->fetch();

                                    echo "<div class='resultado'>
                                        <span>$nombres_p_f_l[0]</span>
                                        <div class='marcador'>
                                        <marc1>".$resul['golesLocal']."</marc1><div style='margin: 0 5px;'> - </div>
                                        <marc2>".$resul['golesVisitante']."</marc2></div>
                                        <span>$nombres_p_f_v[0]</span>
                                    </div>
                                    <fecha>".$resul['fechaPartido']."</fecha>";

                                }
                            }else{
                                echo "<div class='error'>no hay resultados disponibles :</div>";
                            }
                        echo "</section>
                            </div>
                        </div>";

                //Total de partidos jugados
                $t_part_j = "SELECT count(id_resultado) FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id";
                $t_part_j = $conn->query($t_part_j);
                $t_j = $t_part_j->fetch();

                // total de victorias del equipo de Local
                $t_victoriasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_victoriasl = $conn->query($t_victoriasl);
                $t_vl = $t_victoriasl->fetch();

                // total de victorias del equipo como visitante
                $t_victoriasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_victoriasv = $conn->query($t_victoriasv);
                $t_vv = $t_victoriasv->fetch();

                //Numero total de victorias
                $t_vic = $t_vl[0] + $t_vv[0];

                // total de empates 
                $t_empates = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id)";
                $t_empates = $conn->query($t_empates);
                $t_e = $t_empates->fetch();

                // total de derrotas del equipo de Local
                $t_derrotasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_derrotasl = $conn->query($t_derrotasl);
                $t_dl = $t_derrotasl->fetch();

                // total de derrotas del equipo como visitante
                $t_derrotasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_derrotasv = $conn->query($t_derrotasv);
                $t_dv = $t_derrotasv->fetch();

                // numero total de derrotas
                $t_derr = $t_dl[0] + $t_dv[0];

                echo "<section class='estadistics'>
                    <div class='t-esta'>Estadisticas de ".$mostrar_estadisticas['nombreEquipo']."</div>
                        <table>
                            <tr>
                                <td>Puntos:</td>
                                <th>". $mostrar_estadisticas['puntos'] ."</th>
                            </tr>
                            <tr>
                                <td>Partidos Jugados:</td>
                                <th>$t_j[0]</th>
                            </tr>
                            <tr>
                                <td>Victorias:</td>
                                <th>$t_vic</th>
                            </tr>
                            <tr>
                                <td>Derrotas:</td>
                                <th>$t_derr </th>
                            </tr>
                            <tr>
                                <td>Empates:</td>
                                <th> $t_e[0]</th>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>";

                }
            }

        }catch(Exception $e){
            exit("ERROR EQUIPOS: ".$e->getMessage());
        }
    }

    public function crudEquipos(){
        $conn = parent::conectar();
        try{
            $mostrar_equipos = "SELECT id_equipo, nombreEquipo FROM equipos ORDER BY nombreEquipo DESC";
            $consult = $conn->query($mostrar_equipos);

            if($consult->rowCount() > 0){
                       
                echo "<div class='titulo'>Equipos del torneo</div>";
                while($guardar_datos = $consult->fetch()){
                        
                    echo "<div class='equipo_crud'>";
                    echo "<span>". $guardar_datos['nombreEquipo'] . "</span>";
                    echo "<a class='editar derecha' href='editar-equipo.php?editar=".$guardar_datos['id_equipo'] ." '>editar</a>
                    <a class='eliminar derecha' onclick='alerta_delete(".$guardar_datos['id_equipo'].")'>eliminar</a>
                    </div><br>";

                }
            }
            else{
                echo "<h1>Aun no hay equipos en el torneo</h1>";
            }
        }catch(Exception $e){
            exit("ERROR EQUIPOS ADMIN: ".$e->getMessage());
        }
    }

    public function basicsEquipos(){
        $conn = parent::conectar();
        try {
            $id_equipo = $_GET['editar'];
            $ejc = "SELECT * FROM equipos WHERE id_equipo='$id_equipo'";
            $equipo = $conn->query($ejc);
            
            if($equipo->rowCount() > 0){
                $equipoF = $equipo->fetch();
                return $equipoF;
            }
        } catch (Exception $e) {
            exit("ERROR DATOS DE EQUIPO: ".$e->getMessage());
        }
    }
}

$equipos = new Equipos;

?>