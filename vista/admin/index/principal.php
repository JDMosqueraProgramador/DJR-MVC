<section>
    <div class="col-11" style="margin: auto">
        <?php
        include 'modelo/adminModel.php';
        
        ?>
        <h2>Administrador <?php echo $administradoresModel->dataAdmin()[1] . " " . $administradoresModel->dataAdmin()[2]; ?></h2><hr>
    </div>

    <div class="row">
        <div class="col-a6">
            <div class="edit_equipos">

            <script>

            document.addEventListener('DOMContentLoaded', crudEquipos(''));    

            function crudEquipos(send){
                var ht = new XMLHttpRequest;

                ht.addEventListener('readystatechange', function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementsByClassName('edit_equipos')[0].innerHTML = this.responseText;
                    }
                });

                ht.open('POST', 'controlador/ajax/equiposCRUD.php');
                ht.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                ht.send(send);
            }

            
            </script>

            <script>
                function alerta_delete(id){
                    let alert = window.confirm('¿Seguro que desea borrar el equipo?');
                    if(alert == true){
                        crudEquipos("eliminar="+id);
                    }
                }
            </script>
             <?php 

             ?>

            </div>
        </div>

        <div class="col-a6">
            <?php 
            include 'controlador/partidoDelDiaController.php';
            $partidoDelDia->partidoYresultadosAdmin();
            $partidoDelDia->partidosNoJugados();

            ?>

        </div>
    </div>
</section>
