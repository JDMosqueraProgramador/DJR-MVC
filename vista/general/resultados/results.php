<div class="container">
        <div class="row">

            <div class="resultados">
                <div class="dettorneo">
                    Torneo interclases <?php echo date("Y") ?>
                </div>
                <?php
                 require_once 'controlador/resultadosController.php';
                 $resultados->resultadosGeneral();
                 ?>

            </div>

            <div class="espacio">

                <div class="c-grande">
                    <script>
                    let cubo_g = document.getElementsByClassName('c-grande')[0];
                    for(let i = 0; i < 6; i++){
                        linea_c = document.createElement('div');
                        linea_c.className = "linea-c";
                        for(let i = 0; i < 6; i++){
                            cubo_g.appendChild(linea_c);
                            let row = document.createElement('div');
                            row.className = "row";
                            for(let i = 0; i < 6; i++){
                                linea_c.appendChild(row);
                                let cubo = document.createElement('div');
                                cubo.className = "c-peque";
                                row.appendChild(cubo);
                                for(let i = 0;i < 6; i++){
                                    let lado = document.createElement('div');
                                    lado.className = "lado";
                                    cubo.appendChild(lado);
                                }  
                            }
                        }
                        
                    }
                </script>
                <img src="assets/imagenes/jesusrey.jpg">
                <span>Torneo 2019</span>
                </div>
            </div>
            
        </div>
    </div>