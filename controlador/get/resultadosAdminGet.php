<?php

if(isset($_GET['editar_p']) && isset($_GET['local']) && isset($_GET['visita'])){

    require_once 'controlador/resultadosController.php';

    class EditarResultadosForm extends Resutados{
        public function editarResultadosForm(){
            $conn = parent::conectar();
            try {

                $select_equipol = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo =".$_GET['local']);
                $select_equipov = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = ".$_GET['visita']);
                $datos_l = $select_equipol->fetch();
                $datos_v = $select_equipov->fetch();

                $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =".$_GET['editar_p']);
                $ids_partido =$select_partido->fetch();

                $_SESSION['id_jugL'] = [];
                $num_jug_l = $num_jug_v = 0;

                echo "<div class='editar-resultado'><form class='row' method='post' action='editar/editar-partidos/edit-resultados.php' id='form-nr'><input type='hidden' name='id_partido' value='".$_GET['editar_p']."'>";

                echo "<div class='col-a5'><h1>" . $datos_l[0] . "</h1><br>";

                $jugadoresl = $conn->query("SELECT * FROM jugadores WHERE id_equipo_jug = ".$_GET['local'].""); 
                while($jugl = $jugadoresl->fetch()){
                    $idslocales = $jugl['id_jugador'];
                    $jugg_e_l = $conn->query("SELECT * FROM goles WHERE id_jugador_g = ".$jugl['id_jugador']." AND id_partido_g = ".$_GET['editar_p']);
                    $numGl = $jugg_e_l->fetch();
                    if($numGl[3] != null){
                        $numgolesl = $numGl[3];
                    }else{
                        $numgolesl = 0;
                    }
                    echo "<div class='ejr'><div>".$jugl['nombreJugador']. " " .$jugl['apellidosJugador']."</div><input type='number' value='$numgolesl' name='goleslocal$idslocales' class='ngl'></div>";
                    $_SESSION['id_jugL'][] = $idslocales;
                    $num_jug_l++;
                }
                echo "<input type='hidden' value='$num_jug_l' name='num_j_l'>";



                $result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = ".$_GET['editar_p']);
                $resultr = $result->fetch();
                echo "</div>
                <div class='col-a2' style='text-align: center'><br>
                ".$resultr['golesLocal']." - ".$resultr['golesVisitante']."<br><br>
                Partido de la fecha:
                $ids_partido[1]</div>";


                $jugadoresv = $conn->query("SELECT * FROM jugadores WHERE id_equipo_jug = ".$_GET['visita'].""); 

                $_SESSION['id_jugV'] = [];
                echo "<div class='col-a5' style='text-align: right'><h1>$datos_v[0]</h1><br>";
                while($jugv = $jugadoresv->fetch()){
                    $idsvisita = $jugv['id_jugador'];
                    $jugg_e_v = $conn->query("SELECT * FROM goles WHERE id_jugador_g = ".$jugv['id_jugador']." AND id_partido_g = ".$_GET['editar_p']);
                    $numGv = $jugg_e_v->fetch();
                    if($numGv[3] != null){
                        $numgolesv = $numGv[3];
                    }else{
                        $numgolesv = 0;
                    }
                    echo "<div class='ejr'><input type='number' value='$numgolesv' name='golesvisita$idsvisita' value='0' class='ngv'><div>".$jugv['nombreJugador']. " " .$jugv['apellidosJugador']."</div></div>";
                    $_SESSION['id_jugV'][] = $idsvisita;
        
                    $num_jug_v++;
                }
                echo "<input type='hidden' value='$num_jug_v' name='num_j_v'></div>";
        
                echo "<div class='n-m'>Nuevo Marcador:  <span id='rl'></span> - <span id='rv'></span></div> <div class='butt'><input type='submit' value='Modificar Resultado'></div>";
        
                echo "</form></div>"; 


            } catch (Exception $e) {
                exit("ERROR EDITAR RESULTADOS: ".$e->getMessage());
            }
        }
    }

    $EditarResultadosForm = new EditarResultadosForm;

}



?>