<?php

if(1 == 2){

    include 'vista/general/programacion/links.php';
    include 'vista/general/header.php';
    include 'vista/general/menu.php';
    include 'vista/general/programacion/calendario.php';
    include 'vista/general/footer.php';
}else{

    include 'vista/admin/programacion/links.php';
    include 'vista/general/header.php';
    include 'vista/admin/menuadmin.php';
    include 'vista/admin/programacion/formsEditNuevo.php';
    include 'vista/admin/programacion/calendarioAdmin.php';
    include 'vista/general/footer.php';
}
 
?>