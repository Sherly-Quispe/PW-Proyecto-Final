<?php
echo "</br></br>";
ECHO "<center><h1>CUSCO CIUDAD DE LOS INCAS</h1>";
echo <<<_END
<html>
    <head>
        <title>CUSCO PARA EL MUNDO</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/> 
    </head>
    <body bgcolor="red">
    <form method="post" action="principal.php">
    <tr><h4>Ingresa con tu usuario</h4><p></tr>
    <tr><td> Usuario</br>
        <input type="text" id="entrada" name="usuario" placeholder="Ingrese su usuario"></td></tr>
    <tr><td>Password</br>
        <input type="password" id="entrada" name="password" placeholder="Ingrese su Contraseña"></td></tr>
    <tr><td>
        <input type="submit" id="boton" value="Ingresar"></td></tr>
    </form>  
    </body>
</html>
_END;
 $cn = new mysqli('localhost', 'root','', 'proyectofinal',3360);
 if ($cn->connect_error) die ("Fatal error");
 function mysql_fix_string($conexion, $string)
{
    if (get_magic_quotes_gpc())
        $string = stripcslashes($string);
    return $conexion->real_escape_string($string);
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