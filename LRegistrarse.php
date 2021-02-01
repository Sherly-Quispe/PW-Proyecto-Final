<?php
echo "</br></br>";
ECHO "<center><h1>CUSCO CIUDAD DE LOS INCAS</h1>";
echo <<<_END
<html>
    <head>
        <title>CUSCO PARA EL MUNDO</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>     
    </head>
    <body>
      <form method="post" action="LRegistrarse.php">
         <table>
         <tr><td>
               REGISTRATE </br></td></tr>
         <tr><td>Nombres</br>
            <input type="text" id="entrada" name="nombre" placeholder="Ingrese Nombres Completos" required></td></tr>
         <tr><td>Apellidos</br>
            <input type="text" id="entrada" name="apellido" placeholder="Ingrese Apellidos" required></td></tr>
         <tr><td>Usuario</br>
            <input type="text" id="entrada" name="usuario" placeholder="Ingrese tu usuario" required></td></tr>
         <tr><td>Password</br>
            <input type="password" id="entrada" name="password" placeholder="Ingrese Contraseña" required></td></tr>
         <tr><td>
            <input type="submit" id="boton" value="Registrarse"></td></tr>
         <tr><td>
         <a href="Login.php" id="entrada">INGRESAR AL DIARIO</a></tr></br>
         </table>
      </form>
    </body>
</html>
_END;
   $cn = new mysqli('localhost', 'root','', 'proyectofinal',3360);
    if ($cn->connect_error) die ("Fatal error");
    if(isset($_POST['usuario']) && isset($_POST['password']))
    {
        $nombres = mysql_entities_fix_string($cn, $_POST['nombre']);
        $apellidos = mysql_entities_fix_string($cn, $_POST['apellido']);
        $usuario = mysql_entities_fix_string($cn, $_POST['usuario']);
        $password_temporal = mysql_entities_fix_string($cn, $_POST['password']);
        $password = password_hash($password_temporal, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios VALUES". "('$nombres','$apellidos','$usuario', '$password')";
        $query;
        $resultado = $cn->query($query);
        if (!$resultado) die ("Falló al registrarse");

    }
    $query = "SELECT * FROM usuarios";
    $resultado = $cn->query($query);
    if (!$resultado) die ("Error en el acceso a la base de datos");

      $rows = $resultado->num_rows;
      
  function mysql_entities_fix_string($cn, $string)
  {
      return htmlentities(mysql_fix_string($cn, $string));
    }
  function mysql_fix_string($cn, $string)
  {
      if (get_magic_quotes_gpc()) $string = stripslashes($string);
      return $cn->real_escape_string($string);
    }   
?>