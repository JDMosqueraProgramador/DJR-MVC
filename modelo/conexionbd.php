<?php

abstract class BD{
    
    private static $usuario = "root";
    private static $server = "localhost";
    private static $pass = "";
    private static $db = "deportes_jesus_rey";
    private $conn;

    public function conectar(){
        try {
            $stament = "mysql:host=". self::$server .";dbname=" . self::$db;
            $pdo = new PDO($stament, self::$usuario, self::$pass);
            // $pdo->exec("SET CHARACTER SET utf8");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        }catch(PDOException $e){
            exit("ERROR CONEXION: ".$e->getMessage());
        }
    }

    public function desconectar(){
        $this->conn = null;
    }

}

?>