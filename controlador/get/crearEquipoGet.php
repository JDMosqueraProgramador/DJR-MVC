<?php 

$ind_inputs = "";

if(isset($_GET['num_jug'])){
    $ind_inputs = $_GET['num_jug'];
}
else{
    $ind_inputs = 0;
}

if(isset($_GET['num_jug']) && $_GET['num_jug'] == $ind_inputs){

    $cont_inputs = $cont_inputs+$ind_inputs;
}

if($ind_inputs > 5){
    $ind_inputs = 5;
}

$_SESSION['num_jug'] = $cont_inputs;

?>