<?php 

class PartidosModel extends BD{
    public function dataPartidos(){
        $conn = parent::conectar();
        try {
            // Seleccionar partidos porgramados
            $select_encuentros = "SELECT * FROM partidos";
            $select_encuentros = $conn->query($select_encuentros);

            $jsonPartidos = [];

            while($fecha_partido = $select_encuentros->fetch()){
                $id_eq_local = $fecha_partido['id_equipoLocal'];
                $id_eq_vist = $fecha_partido['id_equipoVisitante'];
                $nombreLocal = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_local";
                $nombreVisita = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_vist";
                $nombreLocal = $conn->query($nombreLocal);
                $nombreVisita = $conn->query($nombreVisita);
                $nombreLocalF = $nombreLocal->fetch();
                $nombreVisitaF = $nombreVisita->fetch();


                // extraer cada dato de la fecha extraido
                $momentos = explode("-", $fecha_partido['fechaPartido']); 

                $jsonPartidos[] = array(
                    'fechaPartido' => $fecha_partido['fechaPartido'],
                    'idPartido' => $fecha_partido['id_partido'],
                    'mes' => $momentos[1]-1,
                    'dia' => $momentos[2],
                    'nombreLocal' => $nombreLocalF[0],
                    'nombreVisita' => $nombreVisitaF[0]
                );

  
                
                // echo "<script>

                // // llenar los días en los que ya hay partidos programados

                // marcarFechas();
                // function marcarFechas(){
                    
                //     const mes = document.getElementsByTagName('table')[".($momentos[1]-1)."];
                //     let dia = mes.getElementsByTagName('td');
                //     for(let i = 0; i < dia.length; i++){
                //         if(dia[i].textContent == ".$momentos[2]."){
                //             dia[i].textContent = '".$nombreLocalF[0]." vs ".$nombreVisitaF[0]."';
                //             dia[i].className = 'removeEvent';
                //             let basura = document.createElement('a');
                //             basura.className = 'fas fa-trash';
                //             basura.addEventListener('click', eliminarPartido);
                //             dia[i].appendChild(basura);
                //             dia[i].addEventListener('click', editarPartido);
                //         }
                //     }

                //     // llenar los datos para modificar el partido
                //     function editarPartido(){   

                //         const form_edit = document.getElementById('edit_partido');
                //         const oc_otro_evento = document.getElementById('nuev-progr');

                //         oc_otro_evento.style.top = '-100vh';
                //         form_edit.classList.add('top-o');
                //         document.getElementById('localMod').textContent = '".$nombreLocalF[0]."';
                //         document.getElementById('visitaMod').textContent = '".$nombreVisitaF[0]."';

                //         form_edit.getElementsByTagName('input')[0].value = '".$fecha_partido['fechaPartido']."';
                //         form_edit.getElementsByTagName('input')[0].min = '".date('Y-m-d')."';
                //         form_edit.getElementsByTagName('form')[0].setAttribute('action','editar/editar-partidos/editar-partido.php?editar_p=".$fecha_partido['id_partido']."');
                        
                //         document.getElementById('close-ventEdit').addEventListener('click', function cerrarEdit(){
                //             form_edit.classList.remove('top-o');
                //         });

                //     }

                //     function eliminarPartido(){
                //         let confirm = window.confirm('¿seguro que desea eliminar el encuentro?');
                //         if(confirm == true){
                //             window.location = '?eliminar_partido=".$fecha_partido['id_partido']."';
                //         }else{
                //             const form_edit = document.getElementById('edit_partido');
                //             form_edit.classList.remove('top-o');
                //         }
                //     }    
                // }
                
                // </script>";
            }

            $jsonPartidos = json_encode($jsonPartidos);

            echo $jsonPartidos;
        } catch (Exception $e) {
            exit("ERROR MOSTRAR PARTIDOS: ".$e->getMessage());
        }
    }

    public function deletePartidos($id){
        $conn = parent::conectar();
        try {

            require '../functions.php';
            $id_partido_get = segF($id);
            // verificar si el partido ya tiene o no un resultado
            $ver_resultado = $conn->query("SELECT * FROM resultados WHERE id_partido_res=$id_partido_get");
            if($ver_resultado->rowCount() > 0){
                
            }else{
                $eliminar_partido = "DELETE FROM partidos WHERE id_partido='$id_partido_get'";
                if($conn->query($eliminar_partido) == true){
                    
                }
            }
            
        } catch (Exception $e) {
            exit("ERROR AL ELIMINAR EL PARTIDO: ".$e->getMessage());
        }
    }
}

$partidosModel = new PartidosModel;

?>