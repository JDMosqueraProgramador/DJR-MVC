<div class="container class sec1">
    <div class="row">
        <div class="col-c3 invisible">
            <table class="resultados-i">
                <thead>
                    <tr><th class="th-inicio">Resultados torneo 2019<br>
                        <img src="assets/imagenes/jesusrey.jpg" width="30px" class="circulo">
                    </th>

                    </tr>
                </thead>
                <tbody>
                <?php

                require_once 'controlador/resultadosController.php';
                $resultados->resultadosTablaPrincipal();

                ?>
                    
                </tbody>
            </table>
        </div>
        <div class="col-c5">
            <div class="" style="max-width:100%; overflow:hidden;">
                <img class="mySlides" src="assets/imagenes/1.jpg" style="width:100%">
                <img class="mySlides" src="assets/imagenes/camepones.jpg" style="width:100%">
                <img class="mySlides" src="assets/imagenes/interc.jpg" style="width:100%">
                <img class="mySlides" src="assets/imagenes/10-2.jpg" style="width:100%">
            </div>
        </div>
    <script src="assets/js/slider.js"></script>

        <div class="col-c4 container txt-blanco" style="padding-bottom:20px;padding-top:20px;">
            <div class="text-slider">
                <div class="titles-slider">
                    <div class="title-slides">Bienvenido a</div>
                    <div class="title-slides">Deportes </div>
                    <div class="title-slides">Jesus Rey</div>
                </div>
                <span class="content-slider">
                    Una nueva manera de vivir los deportes en la instutución educativa
                </span>
            </div>
        </div>
    </div>
</div>