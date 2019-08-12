<?php

class Escudos {
    public $escudoName;
    public $escudoTMP;
    public $nombreEquipo;
    public $urlImg;

    public function __construct($escudoName, $escudoTMP, $nombreEquipo){

        $this->escudoName = $escudoName;
        $this->escudoTMP = $escudoTMP;
        $this->nombreEquipo = $nombreEquipo;

        $dirr = "escudos/";
        $file = "../assets/" . $dirr . basename($escudoName); # $_FILES['escudo']['name']
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $ver = getimagesize($escudoTMP); # $_FILES['escudo']['tmp_name']

        try{
            if($ver != true){
                throw new Exception("No es posible aceptar el archivo, por favor cambie el logo de su equipo");
            }elseif($extension != "png" && $extension != "jpg" && $extension != "jpeg"){
                throw new Exception("La extensión del achivo no es de imagen");
            }
        } catch (Exception $th) {
            echo $th->getMessage();
            die();
        }

        if(move_uploaded_file($escudoTMP, $file) === true){
            rename($file,"../assets/escudos/".$nombreEquipo.".png");
            $this->urlImg = $dirr . $nombreEquipo . ".png";
        }
    }

    public function urlImage(){
        return $this->urlImg;
    }

}


?>