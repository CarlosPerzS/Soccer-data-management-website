<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizado</title>
</head>
<body>
    <form action="mostrar.php" method="GET">
        <button type="submit">Ir al menu</button>
    </form>
    <?php
    session_start();
    $tabla=$_SESSION['tabla'];
    $pk=$_SESSION['pk'];
    include ('conexion.php');
    $bd=new BaseDeDatos($_SESSION['user'],$_SESSION['password']);
    $conexion= $bd->getConexion();
    if ($tabla == 'jugador') {
        $Nombre=$_POST['Nombre'];
        $Apellido=$_POST['Apellido'];
        $Nacionalidad=$_POST['Nacionalidad'];
        $Club=$_POST['Club'];
        $Posicion=$_POST['Posicion'];
        $sql="UPDATE jugador SET nombre='$Nombre', apellido='$Apellido', nacionalidad=$Nacionalidad, club=$Club, posicion=$Posicion WHERE nomina=$pk;";
        $actualizar=$conexion->query($sql);
    } 
    elseif ($tabla == 'club') {
        $Nombre=$_POST['Nombre'];
        $Fundacion=$_POST['Fundacion'];
        $Pais=$_POST['Pais'];
        $sql="UPDATE club SET nombre='$Nombre', fundacion='$Fundacion', pais=$Pais WHERE PK_club=$pk;";
        $actualizar=$conexion->query($sql);
    } 
    elseif ($tabla == 'estadistica') {
        $Jugador=$_POST['Jugador'];
        $Torneo=$_POST['Torneo'];
        $Partidos=$_POST['Partidos'];
        $Goles=$_POST['Goles'];
        $sql="UPDATE Estadistica SET Jugador=$Jugador, Torneo=$Torneo, Partidos=$Partidos, Goles=$Goles WHERE PK_Estadistica=$pk;";
        $actualizar=$conexion->query($sql);

    } 
    elseif ($tabla == 'participacion') {
        $Club=$_POST['Club'];
        $Torneo=$_POST['Torneo'];
        $Puntos=$_POST['Puntos'];
        $sql="UPDATE Participacion SET Club=$Club, Torneo=$Torneo, Puntos=$Puntos WHERE PK_Participacion=$pk;";
        $actualizar=$conexion->query($sql);

    } 
    elseif ($tabla == 'torneo') {
        $Nombre=$_POST['Nombre'];
        $Temporada=$_POST['Temporada'];
        $sql="UPDATE Torneo SET Nombre='$Nombre', Temporada='$Temporada' WHERE PK_Torneo=$pk;";
        $actualizar=$conexion->query($sql);
    }
    elseif ($tabla == 'pais') {
        $Nombre=$_POST['Nombre'];
        $sql="UPDATE Pais SET Nombre='$Nombre' WHERE PK_Pais=$pk;";
        $actualizar=$conexion->query($sql);
    }
    elseif ($tabla == 'posicion') {
        $Nombre=$_POST['Nombre'];
        $sql="UPDATE Posicion SET Nombre='$Nombre' WHERE PK_Posicion=$pk;";
        $actualizar=$conexion->query($sql);
    }
    elseif ($tabla == 'usuario') {
        $Nombre=$_POST['Nombre'];
        $Password=$_POST['Password'];
        $Tipo=$_POST['Tipo'];
        $sql="UPDATE Usuario SET Nombre='$Nombre',Password=SHA1('$Password'), Tipo=$Tipo WHERE ID=$pk;";
        $actualizar=$conexion->query($sql);
    }


    echo "Datos actualizados <br>";
    
    ?>
</body>
</html>