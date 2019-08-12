<div class="resultados">
    <div class="dettorneo">
        Torneo interclases <?php echo date("Y") ?>
    </div>

    <?php 
    require_once 'controlador/resultadosController.php';
    $resultados->resultadosAdmin(); 
    
    ?>

</div>

<?php 

require_once 'controlador/get/resultadosAdminGet.php';

?>
