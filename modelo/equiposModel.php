<?php

require_once 'conexionbd.php';

class EquiposModel extends BD{

    public function istEquipo($escudoName, $escudoTMP, $nombreEquipo){

        $conn = parent::conectar();
        try{

            require_once 'archivosController.php';

            $image = new Escudos($escudoName, $escudoTMP, $nombreEquipo);

            $urlImg = $image->urlImage();

            // echo $urlImg;
            $consult_e = $conn->prepare("INSERT INTO equipos(nombreEquipo, escudo) values (:nombreEquipo,:escudo)");
            $consult_e->bindParam(':nombreEquipo', $nombreEquipo);
            $consult_e->bindParam(':escudo', $urlImg);
            $consult_e->execute();
            

        }catch(Exception $e){
            exit("ERROR NUEVO EQUIPO: ".$e->getMessage());
        }

    }

    public function dataEquipo(){
        $conn = parent::conectar();
        try {
            $cons = "SELECT * FROM equipos";
            $consult = $conn->query($cons);
            return $consult;
        } catch (Exception $e) {
            exit("ERROR EQUIPOS: ".$e->getMessage());
        }
    }

    public function deleteEquipo($id){
        $conn = parent::conectar();
        try {
            
            // eliminar escudo
            $escudo = "SELECT escudo FROM equipos WHERE id_equipo=$id";
            $escudo_ej = $conn->query($escudo);
            $dir_escudo = $escudo_ej->fetch();
            if(file_exists("../../assets/".$dir_escudo[0])){
                $elim_escudo = unlink("../../assets/".$dir_escudo[0]);
                if($elim_escudo == false){
                    echo "<div class='errorSistem'>ERROR DEL SISTEMA: No es posible eliminar el escudo del equipo
                    <a href='admin.php'>Has click para volver a cargar la página</a></div>";                
                }
            }
        
            // eliminar equipo
            $eliminar = "DELETE FROM equipos WHERE id_equipo=$id";
            $ejec_elim = $conn->query($eliminar);
            
            if($ejec_elim == false){
                echo "No es posible eliminar al equipo";
            }
        } catch (Exception $e) {
            exit("ERROR ELIMINAR EQUIPO: ".$e->getMessage());
        }
    }
}

$equiposModel = new EquiposModel;



?>