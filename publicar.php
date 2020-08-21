<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalina Store</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
        // setcookie("NombreNegocio", "Servicio Tecnico Oven",time()+60*60*24*1825);

        if(isset($_COOKIE['NombreNegocio'])){
            echo "<div><h3>Nueva publicacion</h3></div>";
            
        }else{
            echo "Debe configurar la app para poder publicar<br>
            <input type='button' value='Configuracion'>";
        }

        $NombreFoto=$_FILES['FotoPublicar'] ['name'];
        $TipoFoto=$_FILES['FotoPublicar'] ['type'];
        $TamaFoto=$_FILES['FotoPublicar'] ['size'];


        $TempDir=$_SERVER['DOCUMENT_ROOT'] . "/fotostemp/";
        move_uploaded_file($_FILES['FotoPublicar'] ['tmp_name'],$TempDir.$NombreFoto);

        echo $TempDir;

        $TextoPublicar=$_POST['TextoPublicar'];
        $PrecioPublicar=$_POST['PrecioPublicar'];
        $CategoriaPublicar=$_POST['CategoriaPublicar'];

        echo $NombreFoto . "<br>" . $TipoFoto . "<br>" . $TamaFoto . "<br>" . $TempDir . "<br>" . $TextoPublicar . "<br>" . $PrecioPublicar . "<br>" . $CategoriaPublicar;



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

        $ArchivoFoto=fopen($TempDir.$NombreFoto,"r");

        $Foto=fread($ArchivoFoto,$TamaFoto);
        
        $Foto=addslashes($Foto);

        fclose($ArchivoFoto);

        $consulta= "insert into publicaciones (foto,descripcion,precio,categoria, fecha,hora,idnegocio) values ('$Foto','$TextoPublicar','$PrecioPublicar','$CategoriaPublicar','".date("d/m/y") ."','". date("H:i") ."',1)";

        $resultado= mysqli_query($conexion,$consulta);

        if(mysqli_affected_rows($conexion) > 0){
            echo "Se ha insertado con exito";
        }else{
            echo "Error al subir imagen";
        }
        
        mysqli_close($conexion);

        header('Location: index.php');
    ?>
</body>
</html>