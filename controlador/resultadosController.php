<?php

class Resutados extends BD{
    
    public function resultadosTablaPrincipal(){
        $conn = parent::conectar();
        try{
            $resultados_generales = $conn->query('SELECT * FROM resultados LIMIT 9');
            if($resultados_generales->rowCount() > 0){
                while($dat_resultados = $resultados_generales->fetch()){
                    $idpartido_r = $dat_resultados['id_partido_res'];
                    $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =$idpartido_r");
                    $ids_partido =$select_partido->fetch();
                    $idl = $ids_partido[2];
                    $idv = $ids_partido[3];
                    $select_equipol = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $idl");
                    $select_equipov = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $idv");
                    $datos_l = $select_equipol->fetch();
                    $datos_v = $select_equipov->fetch();

                    echo "<tr><td class='t-inicio'><span>$datos_l[0]</span> <span class='marcador'> ".$dat_resultados['golesLocal']." - ".$dat_resultados['golesVisitante']." </span> <span>$datos_v[0]</span></td></tr>";
                }
            }else{
                echo "<tr><td class='t-inicio'>Aún no hay resultados disponibles</td></tr>";
            }
        }
        catch(Exception $e){
            exit("ERROR RESULTADOS TABLA PRINCIPAL: ".$e->getMessage());
        }
    }

    public function resultadosGeneral(){
        $conn = parent::conectar();
        try{
            $resultados = "SELECT * FROM resultados";
            $resultados = $conn->query($resultados);
            if($resultados->rowCount() > 0){
                while($dat_resultados = $resultados->fetch()){
                    $idpartido = $dat_resultados['id_partido_res'];
                    $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =$idpartido");
                    $ids_partido =$select_partido->fetch();
                    $idl = $ids_partido[2];
                    $idv = $ids_partido[3];
                    $select_equipol = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idl");
                    $select_equipov = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idv");
                    $datos_l = $select_equipol->fetch();
                    $datos_v = $select_equipov->fetch();

                    $jug_e_l = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idl and id_partido_g = $idpartido";

                    $jug_e_v = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idv and id_partido_g = $idpartido";

                    $jug_e_v = $conn->query($jug_e_v);
                    $jug_e_l = $conn->query($jug_e_l);

                    echo "<div class='resultado-r'>
                    <div class='equ1'>
                        <img src='assets/$datos_l[1]'>
                        <span>$datos_l[0]</span>";


                        if($jug_e_l->rowCount() > 0){
                            while($anotadoresl = $jug_e_l->fetch()){
                                echo "<div class='anot'>".$anotadoresl['nombreJugador']." ".$anotadoresl['apellidosJugador']."(".$anotadoresl['numeroGoles'].")</div>";
                            }
                        }

                    echo "
                    </div>
                    <span class='marcador-r'>".$dat_resultados['golesLocal']." - ".$dat_resultados['golesVisitante']."</span>
                    <div class='fecha-result'>$ids_partido[1]</div>

                    <div class='equ2'>
                        <span>$datos_v[0]</span>
                        <img src='assets/$datos_v[1]'> <br>";

                        if($jug_e_v->rowCount() > 0){
                            while($anotadoresv = $jug_e_v->fetch()){
                                echo "<div class='anot'>".$anotadoresv['nombreJugador']." ".$anotadoresv['apellidosJugador']."(".$anotadoresv['numeroGoles'].")</div>";
                            }
                        }

                        echo "
                            </div>
                        </div>";
                    
                }
            }else{
                echo "<div style='margin:30px auto; padding: 20px'>Aún no hay resultados disponibles</div>";
            }
        }catch (Exception $e) {
            exit("ERROR RESULTADOS GENERAL: ".$e->getMessage());
        }
    }

    public function resultadosAdmin(){
        $conn = parent::conectar();
        try {
            $resultados = "SELECT * FROM resultados";
            $resultados = $conn->query($resultados);
            if($resultados->rowCount() > 0){
                while($dat_resultados = $resultados->fetch()){
                    $idpartido = $dat_resultados['id_partido_res'];
                    $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =$idpartido");
                    $ids_partido =$select_partido->fetch();
                    $idl = $ids_partido[2];
                    $idv = $ids_partido[3];
                    $select_equipol = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idl");
                    $select_equipov = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idv");
                    $datos_l = $select_equipol->fetch();
                    $datos_v = $select_equipov->fetch();
    
                    $jug_e_l = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idl and id_partido_g = $idpartido";
    
                    $jug_e_v = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idv and id_partido_g = $idpartido";
    
                    $jug_e_v = $conn->query($jug_e_v);
                    $jug_e_l = $conn->query($jug_e_l);
    
                    echo "<a href='?editar_p=$idpartido&local=$idl&visita=$idv'><div class='resultado-r'>
                    <div class='equ1'>
                        <img src='assets/$datos_l[1]'>
                        <span>$datos_l[0]</span>";
    
                        if($jug_e_l->rowCount() > 0){
                            while($anotadoresl = $jug_e_l->fetch()){
                                echo "<div class='anot'>".$anotadoresl['nombreJugador']." ".$anotadoresl['apellidosJugador']."(".$anotadoresl['numeroGoles'].")</div>";
                            }
                        }
    
                    echo "
                    </div>
                    <span class='marcador-r'>".$dat_resultados['golesLocal']." - ".$dat_resultados['golesVisitante']."</span>
                    <div class='fecha-result'>$ids_partido[1]</div>
    
                    <div class='equ2'>
                        <span>$datos_v[0]</span>
                        <img src='assets/$datos_v[1]'> <br>";
    
                        if($jug_e_v->rowCount() > 0){
                            while($anotadoresv = $jug_e_v->fetch()){
                                echo "<div class='anot'>".$anotadoresv['nombreJugador']." ".$anotadoresv['apellidosJugador']."(".$anotadoresv['numeroGoles'].")</div>";
                            }
                        }
    
                        echo "
                            </div>
                        </div></a>";
                    
                }
            }else{
                echo "<div style='margin:10px auto; padding: 20px'>Aún no hay resultados disponibles</div>";
            }
        } catch (Exception $e) {
            exit("ERROR RESULTADOS: ".$e->getMessage());
        }
    }
    

}

$resultados = new Resutados;
?>