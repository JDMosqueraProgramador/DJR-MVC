<?php 

class Sanciones extends BD{
    public function sancionados(){
        $conn = parent::conectar();
        try{
            $sanc = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, sanciones.id_partido_f, equipos.nombreEquipo FROM jugadores INNER JOIN sanciones ON jugadores.id_jugador = sanciones.id_jugador_san INNER JOIN equipos ON equipos.id_equipo = jugadores.id_equipo_jug";
            $sanc_c = $conn->query($sanc);
            if($sanc_c->rowCount() > 0){
                while($datos_jugador = $sanc_c->fetch()){
                    echo "<div class='sancionado'  ondratagable='true'>
                    <div class='info_san'>
                        <span>". $datos_jugador['nombreJugador'] . " " . $datos_jugador['apellidosJugador'] ."</span> 
                    </div>
                    <div class='escudo'>
                        <img src='assets/imagenes/boca.png'>
                    </div> 
                    <div class='inform'>
                        <table>
                            <tr><td>Sanción:</td><td>Tarjeta Amarilla</td></tr>
                            <tr><td>Equipo:</td><td>". $datos_jugador['nombreEquipo'] ."</td></tr>
                            <tr><td>Fecha</td><td>". $datos_jugador['id_partido_f'] ."</td></tr>
                            <tr><td>Partido:</td><td>Once dos vs Once uno</td></tr>
                        </table>
                    </div>
                </div>";
                }
            }else{
                echo "<div style='width: 100%; height: 300px; text-align: center;'>Aún no se registra ninguna sanción</div>";
            }
        }catch(Exception $e){
            exit("ERROR SANCIONADOS: ".$e->getMessage());
        }
    }
}

$sanciones = new Sanciones;

?>