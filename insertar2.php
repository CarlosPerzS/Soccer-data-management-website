<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar</title>
</head>
<body>
    <form action="mostrar.php" method="GET">
        <button type="submit">Ir al menu</button>
    </form>
    <?php
    session_start();
    $tabla=$_SESSION['tabla'];
    include ('conexion.php');
    $bd=new BaseDeDatos($_SESSION['user'],$_SESSION['password']);
    $conexion= $bd->getConexion();
    if ($tabla == 'jugador') {
        $Nombre=$_POST['Nombre'];
        $Apellido=$_POST['Apellido'];
        $Nacionalidad=$_POST['Nacionalidad'];
        $Club=$_POST['Club'];
        $Posicion=$_POST['Posicion'];
        $sql="INSERT INTO jugador (nomina, nombre, apellido, nacionalidad, club, posicion) VALUES (NULL, '$Nombre', '$Apellido', $Nacionalidad, $Club, $Posicion);";
        $insertar=$conexion->query($sql);
    } 
    elseif ($tabla == 'club') {
        $Nombre=$_POST['Nombre'];
        $Fundacion=$_POST['Fundacion'];
        $Pais=$_POST['Pais'];
        $sql="INSERT INTO club (PK_Club, nombre, fundacion, pais) VALUES (NULL, '$Nombre', '$Fundacion', $Pais);";
        $insertar=$conexion->query($sql);
    } 
    elseif ($tabla == 'estadistica') {
        $Jugador=$_POST['Jugador'];
        $Torneo=$_POST['Torneo'];
        $Partidos=$_POST['Partidos'];
        $Goles=$_POST['Goles'];
        $sql="INSERT INTO estadistica (PK_Estadistica, jugador, torneo, partidos, goles) VALUES (NULL, $Jugador, $Torneo, $Partidos, $Goles);";
        $insertar=$conexion->query($sql);
    } 
    elseif ($tabla == 'participacion') {
        $Club=$_POST['Club'];
        $Torneo=$_POST['Torneo'];
        $Puntos=$_POST['Puntos'];
        $sql="INSERT INTO participacion (PK_Participacion, club, torneo, puntos) VALUES (NULL, $Club, $Torneo, $Puntos);";
        $insertar=$conexion->query($sql);

    } 
    elseif ($tabla == 'torneo') {
        $Nombre=$_POST['Nombre'];
        $Temporada=$_POST['Temporada'];
        $sql="INSERT INTO torneo (PK_Torneo, nombre, temporada) VALUES (NULL, '$Nombre', '$Temporada');";
        $insertar=$conexion->query($sql);
    }
    elseif ($tabla == 'pais') {
        $Nombre=$_POST['Nombre'];
        $sql="INSERT INTO pais (PK_Pais, nombre) VALUES (NULL, '$Nombre');";
        $insertar=$conexion->query($sql);
    }
    elseif ($tabla == 'posicion') {
        $Nombre=$_POST['Nombre'];
        $sql="INSERT INTO posicion (PK_Posicion, nombre) VALUES (NULL, '$Nombre');";
        $insertar=$conexion->query($sql);
    }
    elseif ($tabla == 'usuario') {
        $Nombre=$_POST['Nombre'];
        $Password=$_POST['Password'];
        $Tipo=$_POST['Tipo'];
        $sql="INSERT INTO Usuario (ID, Nombre, Password, Tipo) VALUES (NULL, '$Nombre', SHA1('$Password'), $Tipo);";
        $insertar=$conexion->query($sql);
    }
    echo "Datos insertados <br>";  
    ?>
</body>
</html>