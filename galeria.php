<?php 
    
    $conexion = new mysqli('localhost', 'root','', 'proyectofinal',3360);
    if ($conexion->connect_error) die ("Fatal error");

    if (isset($_POST['delete']) && isset($_POST['titulo']))
    {   
        $titulo = get_post($conexion, 'titulo');
        $query = "DELETE FROM insercion WHERE titulo='$titulo'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }

    if (isset($_POST['titulo']) &&
        isset($_POST['descripcion']) &&
        isset($_POST['imagen']) )
    {
        $titulo = get_post($conexion, 'titulo');
        $descripcion = get_post($descripcion, 'descripcion');
        $imagen= get_post($conexion, 'imagen');
        $query = "INSERT INTO insercion VALUE" .
            "('$titulo',  '$descripcion','$imagen')";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
    }
ECHO "<h1>CONTENIDO DE NUESTRO DIARIO PERSONAL</h1>";
echo <<<_END
<html>
    <head>
        <title>DIARIO PERSONAL</title>
        <img src="image/contenido.jpg" width="140" height="130"><br>
    </head>
    <body bgcolor=" pink">
    <a href="contenido.php">regresar</a>
    <a href="signup.php">salir</a> 
    </body>
</html>
_END;
    $query = "SELECT * FROM insercion";
    $result = $conexion->query($query);
    if (!$result) die ("Falló el acceso a la base de datos");
    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; $j++)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);
        $r3 = htmlspecialchars($row[3]);

        echo <<<_END
        <pre>
        Titulo de la imagen:$r0
        descripcion: $r1
        imagen: $r2
        
        </pre>
          </pre>
        <form action='sqltest.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='titulo' value='$r0'>
        <input type='submit' value='BORRAR REGISTRO'>
        </form>
        <form action='sqltest.php' method='post'>
        <p>Tema nuevo que remplaza:  <input type='text' name='titulo'>
         Remplazar descripcion:      <input type='text' name='descripcion'>
         Nueva imagen :              <input type="file" name="imagen"/>
        <input type='hidden' name='respuesta' value='yes' >
        <input type='hidden' name='texto' value='$r2' >
        <p><input type='submit' value='Texto modificado'>
        </form>
        _END;
    }
      
    $result->close();
$conexion->close();

function get_post($con, $var)
{
    return $con->real_escape_string($_POST[$var]);
}
        function sanitizeString($var)
        {
            if (get_magic_quotes_gpc())
                $var = stripslashes($var);
                $var = strip_tags($var);
                $var = htmlentities($var);
                return $var;
        }
?>