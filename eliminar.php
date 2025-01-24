<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar</title>
</head>
<body>
    <form action="mostrar.php" method="GET">
        <button type="submit">Ir al menu</button>
    </form>
    <?php
    session_start();
    $tabla=$_SESSION['tabla'];
    $pk=$_POST['dato'];
    $_SESSION['pk']=$pk;
    include ('conexion.php');
    $bd=new BaseDeDatos($_SESSION['user'],$_SESSION['password']);
    $conexion= $bd->getConexion();

    if ($tabla == 'jugador') {
       $sql="DELETE FROM jugador WHERE nomina=$pk;";
       $eliminar=$conexion->query($sql);
    } 
    elseif ($tabla == 'club') {
        $sql="DELETE FROM club WHERE PK_Club=$pk;";
       $eliminar=$conexion->query($sql);
    } 
    elseif ($tabla == 'estadistica') {
        $sql="DELETE FROM estadistica WHERE PK_estadistica=$pk;";
       $eliminar=$conexion->query($sql);
    } 
    elseif ($tabla == 'participacion') {
        $sql="DELETE FROM participacion WHERE PK_participacion=$pk;";
       $eliminar=$conexion->query($sql);
    } 
    elseif ($tabla == 'torneo') {
        $sql="DELETE FROM torneo WHERE PK_torneo=$pk;";
        $eliminar=$conexion->query($sql);
    }
    elseif ($tabla == 'pais') {
        $sql="DELETE FROM pais WHERE PK_pais=$pk;";
        $eliminar=$conexion->query($sql);
    }
    elseif ($tabla == 'posicion') {
        $sql="DELETE FROM posicion WHERE PK_posicion=$pk;";
        $eliminar=$conexion->query($sql);
    }
    elseif ($tabla == 'usuario') {
        $sql="DELETE FROM usuario WHERE ID=$pk;";
        $eliminar=$conexion->query($sql);
    }
    echo "Datos eliminados <br>";


    
    
    ?>
</body>
</html>