<?php

    session_start();

    if(!isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['grado']) || !isset($_POST['correo']) || !isset($_POST['password'])){
        header("location:crear-cuenta.php");
    }

    require_once '../functions.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(segF($_POST['cargo']) == "estudiante"){

            $_SESSION['nombrej'] = segF($_POST['nombre']);
            $_SESSION['apellidosj'] = segF($_POST['apellidos']);
            $_SESSION['gradoj'] = segF($_POST['grado']);
            $_SESSION['correoj'] = segF($_POST['correo']);
            $_SESSION['contrj'] = segF($_POST['password']);

            header("location:../../crear-equipo.php");
        }
        elseif(segF($_POST['cargo']) == "profesor"){

            $verf_cod = explode('-', $_POST['password']);
            if(count($verf_cod) == 2){
                if($verf_cod[1] == "admin_cod"){

                    require_once '../../modelo/adminModel.php';

                    $nomAd = segF($_POST['nombre']);
                    $apAd = segF($_POST['apellidos']);
                    $corAd = segF($_POST['correo']);
                    $contAd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    $administradoresModel->newAdmin($nomAd, $apAd, $corAd, $contAd);

                }else{
                    echo "<script>alert('no cuenta con el permiso para ser administrador');
                    window.location = window.history.back();
                     </script>";
                }
            }else{
                echo "<script>window.alert('no cuenta con el permiso para ser administrador');
                window.location = window.history.back(); </script>";
            }
            
        }
    }

?>