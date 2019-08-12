<div class="mas-jugadores" id="sisisi">
    <span class="cerrar derecha" onclick="mostrarforminputs()"><i class="fas fa-times-circle"></i></span>
    <form action="?num_jug=<?php echo $ind_inputs ?>" method="get">
    Ingrese el numero de jugadores que desea añadir: <br><br>
    <input type="number" name="num_jug" max="5" min="1"><br><br>
    <input type="submit" value="enviar">
    </form>
</div>

<script>
    const mostrarforminputs = () => {
        document.getElementById('sisisi').classList.toggle('top-o'); 
    }
</script>