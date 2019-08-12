<section class="container">
    <h1>Jugadores Sancionados</h1>
    <div class="auto-center">
    <?php 
        require_once 'controlador/sancionesController.php';

        $sanciones->sancionados();

    ?>

    </div>
</section>