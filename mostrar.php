<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imagenes</title>
</head>
<body>
    <h2>INSERTAR IMÁGENES DE LA EXPERIENCIA VIVIDA EN CUSCO</h2>
    <center>
        <table border="2">
            <thead>
               <tr>
                   <th>id</th>
                   <th>Titulo</th>
                   <th>Descripcion</th>
                   <th>Imagen</th>
                   <th>Acción</th>
               </tr> 
            </thead>
            <tbody>
                <?php
                    $host     = 'localhost';
                    $usuario = 'root';
                    $password = '';
                    $basedatos  = 'ayuda';
                    $puerto = '3360';

                    $db = new mysqli($host, $usuario, $password, $basedatos, $puerto);

                    $query="SELECT * FROM insercion";
                    $resultado=$db->query($query);
                    while($row=$resultado->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['titulo']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><img src="data:imagen/jpg:base64,<?php echo base64_encode($row['imagen']); ?>"/></td>
                            <td href="#">MODIFICAR</td>
                            <td href="#">ELIMINAR</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </center>
</body>
</html>