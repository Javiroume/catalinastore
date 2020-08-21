<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        date_default_timezone_set('America/Buenos_Aires');
        
        $connstate="";

        $host="localhost:3308";
        $usuario="root";
        $contra="";
        $nombre="catalinastore";

        $conexion= mysqli_connect($host,$usuario,$contra,$nombre);

        if(mysqli_connect_errno()){
            
            $connstate="Fallo al conectar con la base de datos " . strtoupper($nombre);

            exit();
        }else{
            $connstate="Conexion exitosa a la base de datos <b>" . strtoupper($nombre) . "<br> <br></b>";
        }

        mysqli_select_db($conexion,$nombre) or die ("No se encuentra la base de datos");

        mysqli_set_charset($conexion,"Utf8mb4");

        $consulta= "SELECT p.idnegocio, p.foto, p.descripcion, p.precio, p.fecha,p.hora, n.idnegocio, n.telefono, n.mail FROM publicaciones p, negocios n where p.idnegocio=n.idnegocio and p.fecha='" . date("d/m/y") . "' ORDER BY p.idpublicacion DESC";

        $resultado= mysqli_query($conexion,$consulta);
        
        $Cant=mysqli_num_rows($resultado);

        echo "
            <script>var Cant=(sessionStorage.getItem('Cant'));
            
            if(Cant<".$Cant."){
                $('#DivMsj').fadeToggle(3000);

                setTimeout(() => {
                    $('#DivMsj').fadeToggle(3000);
                }, 8000);
            }
            </script>
        ";

        
        mysqli_close($conexion);

        ?>
</body>
</html>

