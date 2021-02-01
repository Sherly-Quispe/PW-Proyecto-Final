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
        $basedatos = 'ayuda';
        $puerto = '3360';
        
        $con = new mysqli($host, $usuario, $password, $basedatos, $puerto);

        if($con->connect_error){
            die("Connection failed: " . $con->connect_error);
        }
        
        $dataTime = date("Y-m-d H:i:s");
 
        $insercion = $con->query("INSERT into insercion (titulo, descripcion, imagen, creado) VALUES ('$titulo', '$descripcion', '$img', '$dataTime')");
        if($insercion){
            echo "File uploaded successfully.";
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
    
}
echo "<center><h2>REGISTRA TU EXPERIENCIA VIVIDA EN LA CIUDAD DE LOS INCAS</h2></center>";
echo <<<_END
<html lang="en">
<head>
<title>REGISTRA TU EXPERIENCIA</title>
<link href="css/estiloinsertarss.css" rel="stylesheet" type="text/css"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
        ponel titulo:
        <input type="text" name="titulo"/>
        describe:
        <input type="text" name="descripcion"/>
        Select image to upload:
        <input type="file" name="imagen"/>
        <input type="submit" name="submit" value="UPLOAD"/>
    </form>
</body>
</html>
_END;
?>