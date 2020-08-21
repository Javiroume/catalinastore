<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Catalina Store</title>
            <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        $Criterio="";

        // Si es busqueda comun -------------------

        if (isset($_GET['search'])){
            echo "<div><h2 style='color:firebrick'>Resultados para <u>". $_GET['search'] ."</u></h2>";
            $Criterio=$_GET['search'];

        $consulta= "select * from negocios where clave like '%$Criterio%'";        

        $resultado= mysqli_query($conexion,$consulta);
        
        if(mysqli_num_rows($resultado)){
            echo "<br><h3 style='color:firebrick'>Anuncios. Resultados: ". mysqli_num_rows($resultado) ."</h3></div>";
        }else{
            echo "<br><h3 style='color:red'>No hay resultados de anuncios para la busqueda</h3></div>";
        }
    
        while($fila=mysqli_fetch_array($resultado)){

            echo "<div style='color:grey' id='DivResultados' style='text-align:left'>" . $fila["nombre"] . "<br>";

            echo "<img src='data:image/png; base64," . base64_encode($fila["foto"]) . "' style='width:100%' onclick=$('#section').load('publicaciones.php?id=". $fila['idnegocio'] ."');><br>";

            echo "<a href='https://wa.me/". $fila["telefono"] ."'><img src='img/whatsapp.png' style='width:10%'></a></div>";

        }

        $consulta= "select * from publicaciones where descripcion like '%$Criterio%'";        

        $resultado= mysqli_query($conexion,$consulta);

        if(mysqli_num_rows($resultado)){
            echo "<br><div><h3 style='color:firebrick'>Publicaciones. Resultados: ". mysqli_num_rows($resultado) ."</h3></div>";
        }else{
            echo "<br><div><h3 style='color:red'>No hay resultados de publicaciones para la busqueda</h3></div>";
        }

        while($fila=mysqli_fetch_array($resultado)){

            echo "<div id='DivResultados'><img src='data:image/png; base64," . base64_encode($fila["foto"]) . "' style='width:100%'><br>";

            echo $fila["descripcion"] . "<br>";

            echo "<h2 style='color:teal'>" . $fila["precio"] . "</h2><br>";

            echo "<h3 style='color:teal' onclick=$('#section').load('publicaciones.php?id=". $fila['idnegocio'] ."');>Ver vendedor</h3></div>";

        }

        
        }

        // Si es por categoria ----------------------------

        if (isset($_GET['cat'])){
            echo "<div><h2 style='color:firebrick'>Categoria <u>". $_GET['cat'] ."</u></h2></div>";
            $Criterio=$_GET['cat'];

            if ($Criterio=='Todos los anuncios'){
                $consulta="select * from negocios";

                $resultado= mysqli_query($conexion,$consulta);

            echo "<div><br><h3 style='color:firebrick'>Anuncios</h3></div>";
    
            while($fila=mysqli_fetch_array($resultado)){

                echo "<div style='color:grey' id='DivResultados'>" . $fila["nombre"] . "<br>";

                echo "<img src='data:image/png; base64," . base64_encode($fila["foto"]) . "' style='width:100%' onclick=$('#section').load('publicaciones.php?id=". $fila['idnegocio'] ."');><br>";

                echo "<a href='https://wa.me/". $fila["telefono"] ."'><img src='img/whatsapp.png' style='width:10%'></a></div>";

            }

            }else{
                $consulta="SELECT distinct n.idnegocio, n.nombre, n.foto, n.telefono, p.descripcion, p.precio from negocios n, publicaciones p where p.categoria='". $Criterio ."' and n.idnegocio=p.idnegocio";

            

                $resultado= mysqli_query($conexion,$consulta);

                echo "<div><br><h3 style='color:firebrick'>Anuncios</h3></div>";
    
                while($fila=mysqli_fetch_array($resultado)){

                    echo "<div style='color:grey' id='DivResultados'>" . $fila["nombre"] . "<br>";

                    echo "<img src='data:image/png; base64," . base64_encode($fila["foto"]) . "' style='width:100%' onclick=$('#section').load('publicaciones.php?id=". $fila['idnegocio'] ."');><br>";

                    echo "<a href='https://wa.me/". $fila["telefono"] ."'><img src='img/whatsapp.png' style='width:10%'></a></div>";

                }
            }

        }

        mysqli_close($conexion);
        
        ?>
        </body>
        </html>