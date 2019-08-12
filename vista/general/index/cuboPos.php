<div class="row" style='margin: 40px auto auto auto'>
    <div class="col-b5">

        <!-- Cubo -->

        <div class="wrap"> 
            <div class="cubo" id="cubo" style=" transform: rotateY(40deg) rotateX(60deg) "> 
                <div class="delante"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div> 
                <div class="atras"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div>
                <div class="arriba"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div> 
                <div class="abajo"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div> 
                <div class="izquierdaC"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div> 
                <div class="derechaC"><img class="circulo" src="assets/imagenes/balon-1.jpg"></div> 
                </div> 
            </div>
        </div>
        <script src="assets/js/cubo.js"></script>
    <div class="col-b6">

            <table class="t-pos">
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Nombre de equipo</th>
                    <th>pts</th><th>Pj</th><th>V</th><th>E</th><th>D</th><th>GF</th><th>GC</th><th>DG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                require_once 'controlador/equiposController.php';

                
                $equipos->tablaDePosiciones();
                
                ?>
                
            </tbody>
        </table>
    </div>
</div>