
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Catalina Store</title>
        </head>
        <body>
            
        
        <?php
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
    
            mysqli_set_charset($conexion,"utf8");
    
            $consulta= "select * from negocios where idnegocio=" . $_GET['id'];
    
            $resultado= mysqli_query($conexion,$consulta);    
    
            while($fila=mysqli_fetch_array($resultado)){
    
                echo "<div><h2 style='color:firebrick'>". $fila['nombre'] ."</h2><br>";

                echo "<img src='img/infonegocio.png' onclick=$('#DivInfo').fadeToggle(3000); style='width:20px'></div>";

                echo "
                <div id='DivInfo' style='display:none; width: fit-content'>
                    <a href='tel:". $fila['telefono'] ."'><img src='img/call.png' style='width:32px'></a>
                    <a href='mailto:". $fila['mail'] ."'><img src='img/mail.png' style='width:32px'></a>
                    <a href='https://wa.me/". $fila["telefono"] ."'><img src='img/whatsapp.png' style='width:32px'></a>
                </div>
                ";
    
            }
    
            mysqli_close($conexion);






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

        $consulta= "select * from publicaciones where idnegocio=" . $_GET['id'] . " order by fecha desc";

        $resultado= mysqli_query($conexion,$consulta);    

        while($fila=mysqli_fetch_array($resultado)){

            echo "<div id='DivResultados'><img src='data:image/png; base64," . base64_encode($fila["foto"]) . "' style='width:100%'><br>";

            echo $fila["descripcion"] . "<br>";

            echo "<h2 style='color:teal'>" . $fila["precio"] . "</h2><br>";

            echo "<p style='color:grey'>Fecha de publicacion: " . $fila['fecha'] . "</p></div>";

        }

        mysqli_close($conexion);
        ?>
        </body>
        </html>