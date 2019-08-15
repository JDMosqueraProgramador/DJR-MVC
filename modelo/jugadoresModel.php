
<?php

class JugadoresModel extends BD{
    public function istJugadores(){
        $conn = parent::conectar();
        try{
            $cpie = "SELECT id_equipo FROM equipos ORDER BY id_equipo DESC LIMIT 1";
            $cpie_e = $conn->query($cpie);

            if($cpie_e->rowCount() > 0){
                while($id_equipo_f = $cpie_e->fetch()){
                    $id_equipo = $id_equipo_f['id_equipo'];
                }
            }
            
            $consult_j = $conn->prepare("INSERT INTO jugadores(nombreJugador, apellidosJugador, grupoJugador, id_equipo_jug) values (:nombreJugador,:apellidosJugador,:grupoJugador,:id_equipo)");
            $consult_j->bindParam(':nombreJugador', $nombreJug); 
            $consult_j->bindParam(':apellidosJugador', $apJug);
            $consult_j->bindParam(':grupoJugador', $gradoJug);
            $consult_j->bindParam(':id_equipo', $id_equipo);


            for($i = 1; $i <= $_SESSION['num_jug']; $i++){

                $nombreJug = segF($_POST['nombre'.$i]);
                $apJug = segF($_POST['apellidos'.$i]);
                $gradoJug = segF($_POST['grado'.$i]);
                
                $consult_j->execute();
            }
        }catch(Exception $e){
            exit("ERROR NUEVO JUGADOR: ".$e->getMessage());
        }
    }

    public function dataJug($id_equipo){
        $conn = parent::conectar();
        try{
            $ejc_j = "SELECT * FROM jugadores WHERE id_equipo_jug='$id_equipo'";
            $jugadoresQ = $conn->query($ejc_j);

            if($jugadoresQ->rowCount() > 0){
                while($infoJug = $jugadoresQ->fetch()){
                    $id_jugador = $infoJug['id_jugador'];
                    echo "
                    <div>".$infoJug['nombreJugador']."</div>".
                    "<div>".$infoJug['apellidosJugador']."</div>".
                    "<div>".$infoJug['grupoJugador']."</div>

                    <div class='btn-crud edit'><a onclick='editarJugador(\"".$infoJug['nombreJugador'] ."\", \"".$infoJug['apellidosJugador']."\", \"".$infoJug['grupoJugador']."\", \"".$infoJug['id_jugador']."\")'><i class='fas fa-user-edit'></i></a> </div>
                    <div class='btn-crud elim pointer' onclick='crudJugadores(\"editar=$id_equipo&elimJug=$id_jugador\")'><i class='far fa-window-close'></i></div>";
                }
            } 
        }catch(Exception $e){
            exit("ERROR DATA JUGADORES: ".$e->getMessage());
        }

    }

    public function deleteJugador($id){
        $conn = parent::conectar();
        try {
            require_once '../functions.php';
            $id = segF($id);
            $query = $conn->query("DELETE FROM jugadores WHERE id_jugador=$id");
            if($query == true){
                echo "<div class='alertAction'>Se ha eliminado el jugador correctamente</div>";
            }

        }catch(Exception $e){
            exit("ERROR ELIMINAR JUGADOR: ".$e->getMessage());
        }
    }

    public function istNuevoJugador($name, $lastName, $grupo, $id){
        $conn = parent::conectar();
        try{
            require_once '../functions.php';
            $name = segF($name);
            $lastName = segF($lastName);
            $grupo = segF($grupo);
            $insert = $conn->prepare("INSERT INTO jugadores SET nombreJugador=:nombre, apellidosJugador=:apellidos, grupoJugador=:grupo, id_equipo_jug=:id");
            $insert->bindParam(':nombre', $name);
            $insert->bindParam(':apellidos', $lastName);
            $insert->bindParam(':grupo', $grupo);
            $insert->bindParam(':id', $id);
            $insert->execute();
            if($insert->errorCode() == '00000'){
                echo "<div class='alertAction'>Se ha agregado el jugador correctamente</div>";
            }
            
        }catch(Exception $e){
            exit("ERROR NUEVO JUGADOR: ".$e->getMessage());
        }
    }

    public function updtJugador($name, $lastName, $grupo, $id){
        $conn = parent::conectar();
        try{
            
            require_once '../functions.php';
            $name = segF($name);
            $lastName = segF($lastName);
            $grupo = segF($grupo);
            $insert = $conn->prepare("UPDATE jugadores SET nombreJugador=:nombre, apellidosJugador=:apellidos, grupoJugador=:grupo  WHERE id_jugador=:id");
            $insert->bindParam(':nombre', $name);
            $insert->bindParam(':apellidos', $lastName);
            $insert->bindParam(':grupo', $grupo);
            $insert->bindParam(':id', $id);
            $insert->execute();
            if($insert->errorCode() == '00000'){
                echo "<div class='alertAction'>Los datos del jugador han sido actualizados</div>";
            }
            
        }catch(Exception $e){
            exit("ERROR NUEVO JUGADOR: ".$e->getMessage());
        }
    }
}

$jugadoresModel = new JugadoresModel;

?>