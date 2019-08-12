<?php

require_once 'conexionbd.php';

class Administradores extends BD{
    
    public function newAdmin($nombreAd, $apellidosAd, $correoAd, $contrAd){
        $conn = parent::conectar();
        try {
            $insert_admin = $conn->prepare("INSERT INTO administradores (nombreAdmin, apellidosAdmin, correoAdmin, contrAdmin) VALUES (:nombreAd ,:apellidosAd ,:correoAd,:contrAd)");
            $insert_admin->bindParam(':nombreAd', $nombreAd);
            $insert_admin->bindParam(':apellidosAd', $apellidosAd);
            $insert_admin->bindParam(':correoAd', $correoAd);
            $insert_admin->bindParam(':contrAd', $contrAd);
            $insert_admin->execute();

            if($insert_admin->errorCode() == "0000"){
                $_SESSION['sesion_admin'] = $correoAd;
                $_SESSION['sesion_activa'] = true;

                header("location:../admin.php");
            }else{
                throw new Exception("No es posible registrar como profesor");
            }

        } catch (Exception $e) {
            echo "<script>alert(".$e->getMessage()."); window.location = history.back();</script>";
            exit("ERROR NUEVO ADMIN: ".$e->getMessage());
        }
    }

    public function dataAdmin(){
        $conn = parent::conectar();
        try {
            $correo_admin = "juan@gmail.com";#$_SESSION['sesion_admin'];
            $dat_admin = "SELECT * FROM administradores WHERE correoAdmin='$correo_admin'";
            $dat_admin = $conn->query($dat_admin);
            $data_admin = $dat_admin->fetch();
            return $data_admin;
        } catch (Exception $e) {
            exit("ERROR MOSTRAR ADMIN: ".$e->getMessage());
        }
    }
}

$administradoresModel = new Administradores;


?>