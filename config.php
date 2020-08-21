<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalina Store</title>
</head>
<body>

    


<?php
    if (isset($_COOKIE['NombreNegocio'])){
       echo $_COOKIE['NombreNegocio'];
    }else{
        setcookie("NombreNegocio", "Servicio Tecnico Oven",time()+60*60*24*1825);
    }

    echo "<br>";
    
    if(isset($_COOKIE['IdNegocio'])){
       echo $_COOKIE['IdNegocio'];
    }else{
        setcookie("IdNegocio", "1",time()+60*60*24*1825);
    }


?>
</body>
</html>

