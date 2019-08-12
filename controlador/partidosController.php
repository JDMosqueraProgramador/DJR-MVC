<?php

class Partidos extends BD{
    public function calendarioMenu(){
        $conn = parent::conectar();
        try{
            $fecha_hoy = date('Y-m-d');
            $select_encuentros = "SELECT * FROM partidos WHERE fechaPartido >= '$fecha_hoy' ORDER BY fechaPartido ASC LIMIT 5";
            $select_encuentros = $conn->query($select_encuentros);
        
            while($fecha_partido = $select_encuentros->fetch()){
                $id_eq_local = $fecha_partido['id_equipoLocal'];
                $id_eq_vist = $fecha_partido['id_equipoVisitante'];
                $nombreLocal = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_local";
                $nombreVisita = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_vist";
                $nombreLocal = $conn->query($nombreLocal);
                $nombreVisita = $conn->query($nombreVisita);
                $nombreLocalF = $nombreLocal->fetch_row();
                $nombreVisitaF = $nombreVisita->fetch_row();
        
                $momentos = explode("-", $fecha_partido['fechaPartido']); 

                echo "<li>
                <div class='fecha-c'>
                <h3>$momentos[1]<br><span>$momentos[2]</span></h3>
                </div>
                <a href='programacion.php'>$nombreLocalF[0] vs $nombreVisitaF[0]</a>
                </li>";
            }

        }catch(Exception $e){
            exit("ERROR CALENDARIO MENU: ".$e->getMessage());
        }
    }

    public function partidosResultadosProgramacion(){ 
        $conn = parent::conectar();
        try {
            $select_encuentros = "SELECT * FROM partidos";
            $select_encuentros = $conn->query($select_encuentros);
        
            while($fecha_partido = $select_encuentros->fetch()){
                $id_eq_local = $fecha_partido['id_equipoLocal'];
                $id_eq_vist = $fecha_partido['id_equipoVisitante'];
                $nombreLocal = "SELECT nombreEquipo, puntos, escudo FROM equipos WHERE id_equipo = $id_eq_local";
                $nombreVisita = "SELECT nombreEquipo, puntos, escudo FROM equipos WHERE id_equipo = $id_eq_vist";
                $nombreLocal = $conn->query($nombreLocal);
                $nombreVisita = $conn->query($nombreVisita);
                $nombreLocalF = $nombreLocal->fetch();
                $nombreVisitaF = $nombreVisita->fetch();
               
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/
        
                // total de victorias del equipo de Local << local >>
                $t_victoriasll = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_local;
                $t_victoriasll = $conn->query($t_victoriasll);
                $tl_vl = $t_victoriasll->fetch();
        
                // total de victorias del equipo como visitante << local >>
                $t_victoriasvl = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_local;
                $t_victoriasvl = $conn->query($t_victoriasvl);
                $tl_vv = $t_victoriasvl->fetch();
        
                //Numero total de victorias
                $tl_vic = $tl_vl[0] + $tl_vv[0];
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/
        
                // total de victorias del equipo de Local << visita >>
                $t_victoriaslv = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_vist;
                $t_victoriaslv = $conn->query($t_victoriaslv);
                $tv_vl = $t_victoriaslv->fetch();
        
                // total de victorias del equipo como visitante << visita >>
                $t_victoriasvv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_vist;
                $t_victoriasvv = $conn->query($t_victoriasvv);
                $tv_vv = $t_victoriasvv->fetch();
        
                //Numero total de victorias
                $tv_vic = $tv_vl[0] + $tv_vv[0];
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/
        
                // total de empates Local
                $t_empatesl = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_eq_local OR partidos.id_equipoVisitante = $id_eq_local)";
                $t_empatesl = $conn->query($t_empatesl);
                $tl_e = $t_empatesl->fetch();
        
                 // total de empates Visitante
                 $t_empatesv = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_eq_vist OR partidos.id_equipoVisitante = $id_eq_vist)";
                 $t_empatesv = $conn->query($t_empatesv);
                 $tv_e = $t_empatesv->fetch();
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/        
        
                // total de derrotas del equipo de Local << local >>
                $t_derrotasll = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_local";
                $t_derrotasll = $conn->query($t_derrotasll);
                $tl_dl = $t_derrotasll->fetch();
        
                // total de derrotas del equipo como visitante << local >>
                $t_derrotasvl = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_local";
                $t_derrotasvl = $conn->query($t_derrotasvl);
                $tl_dv = $t_derrotasvl->fetch();
        
                // numero total de derrotas << local >>
                $tl_derr = $tl_dl[0] + $tl_dv[0];
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/
              
        
                // total de derrotas del equipo de Local << visita >>
                $t_derrotaslv = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_vist";
                $t_derrotaslv = $conn->query($t_derrotaslv);
                $tv_dl = $t_derrotaslv->fetch();
        
                // total de derrotas del equipo como visitante << visita >>
                $t_derrotasvv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_vist";
                $t_derrotasvv = $conn->query($t_derrotasvv);
                $tv_dv = $t_derrotasvv->fetch();
        
                // numero total de derrotas << visita >>
                $tv_derr = $tv_dl[0] + $tv_dv[0];
        
                /* -------------------------------------------------- *\
                \*----------------------------------------------------*/  
        
        
                $momentos = explode("-", $fecha_partido['fechaPartido']);   
                
                echo "<script>
                
                marcarFechas();
                function marcarFechas(){
                    
                    const mes = document.getElementsByTagName('table')[".($momentos[1])."];
                    let dia = mes.getElementsByTagName('td');
                    for(let i = 0; i < dia.length; i++){
                        if(dia[i].textContent == ".$momentos[2]."){
                            let sp_partido = document.createElement('div');
                            sp_partido.className += 'partido pointer';
                            sp_partido.textContent = '".$nombreLocalF[0]." vs ".$nombreVisitaF[0]."';
                            dia[i].appendChild(sp_partido); 
                            dia[i].addEventListener('click', mostrarEst);
                            function mostrarEst(){
                                
                                var loc = document.getElementById('esLocal'), vis = document.getElementById('esVisita');
                                let escL = document.getElementById('escL'), escV = document.getElementById('escV');
                                escL.src = 'assets/$nombreLocalF[2]';
                                escV.src = 'assets/$nombreVisitaF[2]';
        
                                loc.textContent = '".$nombreLocalF[0]."';
                                vis.textContent = '".$nombreVisitaF[0]."';
                                
                                const est = document.getElementById('estadisticas');
                                const tbod = est.getElementsByTagName('tbody')[0];
                                var trs = tbod.getElementsByTagName('tr');
                                
                                var tds = trs[0].getElementsByTagName('td');
                                tds[0].textContent = ' $nombreLocalF[1] ';
                                tds[2].textContent = ' $nombreVisitaF[1] ';
        
                                var tds = trs[1].getElementsByTagName('td');
                                tds[0].textContent = ' $tl_vic ';
                                tds[2].textContent = ' $tv_vic ';
        
                                var tds = trs[2].getElementsByTagName('td');
                                tds[0].textContent = ' $tl_derr';
                                tds[2].textContent = ' $tv_derr ';
        
                                var tds = trs[3].getElementsByTagName('td');
                                tds[0].textContent = ' $tl_e[0]';
                                tds[2].textContent = ' $tv_e[0] ';
                                    
                          
        
                                est.style.display = 'block';
                                document.getElementById('close').addEventListener('click',function cerrarEsaMonda(){
                                    est.style.display = 'none';
                                });
        
                                document.addEventListener('click', function(e){
                                    if(e.target != est){
                                        est.style.display = 'none';
                                    }
                                }, true);
        
        
                            }
                
                        }
                    } 
                }
                
                </script>";
            }

        } catch (Exception $e) {
            exit("ERROR PROGRAMACION RESULTADOS - PARTIDOS: ".$e->getMessage());
        }
    }



    
}

$partidos = new Partidos;

?>