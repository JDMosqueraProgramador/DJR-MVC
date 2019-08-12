<div class="container">
    <table class="t-pos" style="margin: 30px 0;">
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