<?php 

if(1 == 2){

    include 'vista/general/resultados/links.php';
    include 'vista/general/header.php';
    include 'vista/general/menu.php';
    include 'vista/general/resultados/results.php';
    include 'vista/general/footer.php';
}else{
    include 'vista/admin/resultados/links.php';
    include 'vista/general/header.php';
    include 'vista/admin/menuadmin.php';
    include 'vista/admin/resultados/resultAdmin.php';
    include 'vista/general/footer.php';
}

?>