<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/diseño.css">
    <link rel="stylesheet" href="assets/css/cubo.css">
    <link rel="stylesheet" href="assets/css/logins.css">
    <!-- <link rel="stylesheet" href="assets/css/all.css"> -->
    <link rel="icon" href="assets/imagenes/jesusrey.jpg">
    <?php
    if(isset($linksStyles) && !empty($linksStyles)){
        for($i = 0; $i < count($linksStyles); $i++){
            echo "<link rel='stylesheet' href='assets/$linksStyles[$i]'>";
        }
    }
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
    <title><?php if(isset($nombrePagina)) echo $nombrePagina ?> DJR</title>
    <script src="assets/js/main.js"></script>
</head>
<body>