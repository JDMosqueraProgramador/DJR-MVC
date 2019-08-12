<?php 

class CapitanesModel extends BD{
    public $insert;
    public function istCapitan(){
        $conn = parent::conectar();
        try {
            $insert_id_equipo = "SELECT id_equipo FROM equipos ORDER BY id_equipo DESC LIMIT 1";
            $inst_id_equipo = $conn->query($insert_id_equipo);

            $this->insert = $conn->prepare("INSERT INTO capitanes(correoCapitan, contrCapitan, id_equipo_cap, id_jugador_cap) VALUES (:correo,:contra,:id_equipo,:id_jug)");
            $this->insert->bindParam(':correo', $correoCapitan);
            $this->insert->bindParam(':contra', $contrCapitan);
            $this->insert->bindParam(':id_equipo', $id_equipo_cap);
            $this->insert->bindParam(':id_jug', $id_jugador_cap);

            $mirar_id_jug = $conn->query("SELECT id_jugador FROM jugadores ORDER BY id_jugador DESC LIMIT 1");

            if($mirar_id_jug->rowCount() > 0){
                $id_cap = $mirar_id_jug->fetch();

                $id_jugador_cap = $id_cap[0] + 1;
            }else{
                $id_jugador_cap = 1;
            }

            $correoCapitan = segF($_SESSION['correoj']);
            $contrCapitan = password_hash($_SESSION['contrj'], PASSWORD_DEFAULT);

            if($inst_id_equipo->rowCount() > 0){
                while($idddd = $inst_id_equipo->fetch()){
                    $id_equipo_cap = $idddd['id_equipo'];
                }
            }

        } catch (Exception $e) {
            exit("ERROR NUEVO CAPITAN: ".$e->getMessage());
        }
    }

    public function executeIstCap(){
        $this->insert->execute();
    }
}

$capitanesModel = new CapitanesModel;

?>