<div id="estadisticas" class='estadisticas'>
    <span id="close"><i class='fas fa-times-circle'></i></span>
    <table>
        <thead>
            <tr> 
            <td><img src="" id='escL'><br><span id='esLocal'></span></td>
            <td>vs</td>
            <td><img src="" id='escV'><br><span id='esVisita'></span></tr> </tr>
        </thead>
        <tbody>
            <tr><td></td> <td>Puntos</td> <td></td></tr>
            <tr><td></td> <td>victorias</td> <td></td></tr>
            <tr><td></td> <td>Derrotas</td> <td></td></tr>
            <tr><td></td> <td>Empates</td> <td></td></tr>
            
        </tbody>
    </table>

</div>

<div class="calendario-completo">
    <div class="pass_cal">
        <button id="preC"><i class="fas fa-arrow-left"></i></button>
        <button id="nextC"><i class="fas fa-arrow-right"></i></button>
    </div>

    <script src="assets/js/calendario_user.js"></script>
    <script src="assets/js/pasarCalendario.js"></script>
    
    <?php
    require_once 'controlador/partidosController.php';
    
    $partidos->partidosResultadosProgramacion();
    
    ?>
 

</div>
