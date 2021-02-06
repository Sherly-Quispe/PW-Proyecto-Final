<?php
if(isset($_POST["submit"])){
    $titulo=$_POST["titulo"];
    $descripcion=$_POST["descripcion"];
    $insertar = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($insertar !== false){
        $imagen = $_FILES['imagen']['tmp_name'];
        $img = addslashes(file_get_contents($imagen));

        
        $host     = 'localhost';
        $usuario = 'root';
        $password = '';
        $basedatos = 'proyectofinal';
        $puerto = '3360';
        
        $con = new mysqli($host, $usuario, $password, $basedatos, $puerto);

        if($con->connect_error){
            die("Conexion fallida: " . $con->connect_error);
        }
        
 
        $insercion = $con->query("INSERT into insercion (titulo, descripcion, imagen) 
        VALUES ('$titulo', '$descripcion', '$img')");
        if($insercion){
            echo "Tu imagen se subió correctamente.";
        }else{
            echo "Error al cargar su  archivo, intentelo de nuevo.";
        } 
    }else{
        echo "Seleccione un archivo de imagen para cargar.";
    }
    
}
include "Principal.php";
echo "<center><h2>REGISTRA TU EXPERIENCIA VIVIDA EN LA CIUDAD DE LOS INCAS</h2></center>";
echo <<<_END
<html lang="en">
<head>
<title>REGISTRA TU EXPERIENCIA</title>

<link href="css/ulestilo.css" rel="stylesheet" type="text/css"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="contenido">
<form  action="insertar.php" method="post" enctype="multipart/form-data">
        <h3>Poner el titulo a su imagen</h3>
        <input type="text" name="titulo"/>
        <h3>Poner la descripcion de su imagen</h3>
        <input type="text" name="descripcion"/>
        <h3>Seleccione su imagen</h3>
        <input type="file" name="imagen"/>
        <input type="submit" name="submit" value="SUBIR"/>
    </form>
    </div>
</body>
</html>
_END;
?>