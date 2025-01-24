<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar</title>
</head>
<body>
<style>
    body{
        color:black;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-color:whitesmoke;
    }
    h1{
        background-color: lightgray;
        color:midnightblue;
        font-size: 20px;
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        text-align: center;
        margin: 0;
    }
    button {
        background-color:lightsteelblue;
        color: black;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 17px;
        margin: 5px;
    }
    table {
        border-collapse: collapse;
        width: 80%;
        margin-top: 10px;
    }
    h2 form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Espacio entre botones */
        margin: 20px 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-color: lightgray;
    }
    </style>
    <?php
    //iniciar una sesion 
    session_start();
    $nombre = $_SESSION['nombre'];
    $user=$_SESSION['user'];
    include ('conexion.php');
    
    $bd = new BaseDeDatos($_SESSION['user'], $_SESSION['password']); //conexion con la bd
    $conexion = $bd->getConexion();  

    echo "<h1>Conexión exitosa<br>"; 
    echo "Bienvenido ";
    echo $nombre; // Para evitar problemas de seguridad como XSS
    echo "</h1>";

    echo"<form action='logout.php' method='post'>"; //cerrar sesion
    echo'<button type="submit">Cerrar sesion</button>';
    echo '</form>';
    
    echo "<h2>";
    echo '<form method="post">';
    echo '<button type="submit" name="tabla" value="jugador">Mostrar jugadores</button>'; //opciones de tablas
    echo '<button type="submit" name="tabla" value="club">Mostrar clubes</button>';
    echo '<button type="submit" name="tabla" value="estadistica">Mostrar estadisticas de jugadores</button>';
    echo '<button type="submit" name="tabla" value="participacion">Mostrar participaciones de equipos</button>';
    echo '<button type="submit" name="tabla" value="torneo">Mostrar torneos</button>';
    echo '<button type="submit" name="tabla" value="pais">Mostrar paises</button>';
    echo '<button type="submit" name="tabla" value="posicion">Mostrar posicion</button>';
    if($_SESSION['user']=='Administrador'){
    echo '<button type="submit" name="tabla" value="usuario">Mostrar usuarios</button>';
    }
    echo '</form> </h2>';


    $tablaSeleccionada = $_POST['tabla'] ?? 'jugador';
    $_SESSION['tabla']= $tablaSeleccionada; 

    //consultas dependiendo de la tabla
    if ($tablaSeleccionada == 'jugador') {
        $sql = "SELECT jugador.nomina, jugador.nombre, jugador.apellido, club.nombre as club, pais.nombre as pais, posicion.nombre as posicion
                FROM JUGADOR 
                INNER JOIN Club on jugador.club=club.pk_club 
                INNER JOIN Pais on jugador.nacionalidad=pais.pk_pais 
                INNER JOIN Posicion on jugador.posicion=posicion.pk_posicion 
                ORDER BY jugador.nomina;";
        $headers = ['Nomina', 'Nombre', 'Apellido', 'Club', 'Nacionalidad', 'Posición'];
    } 
    elseif ($tablaSeleccionada == 'club') {
        $sql = "SELECT club.pk_club, club.nombre, pais.nombre as Pais, club.fundacion 
                FROM Club 
                INNER JOIN Pais on Club.pais=pais.pk_pais;";
        $headers = ['PK_Club', 'Club', 'Pais', 'Fundación'];
    } 
    elseif ($tablaSeleccionada == 'estadistica') {
        $sql = "SELECT estadistica.pk_estadistica, jugador.nombre, jugador.apellido, torneo.nombre as torneo, torneo.temporada, estadistica.partidos, estadistica.goles 
                FROM Estadistica 
                INNER JOIN Jugador ON Jugador.nomina=estadistica.jugador 
                INNER JOIN Torneo ON Torneo.pk_torneo=estadistica.torneo ORDER BY estadistica.pk_estadistica;";
        $headers = ['PK_Estadistica', 'Nombre', 'Apellido','Torneo','Temporada', 'Partidos', 'Goles'];
    } 
    elseif ($tablaSeleccionada == 'participacion') {
        $sql = "SELECT participacion.pk_participacion, club.nombre, torneo.nombre as torneo, torneo.temporada, participacion.puntos
                FROM Participacion 
                INNER JOIN Club ON Club.pk_club=participacion.club 
                INNER JOIN Torneo ON Torneo.pk_torneo=participacion.torneo;";
        $headers = ['PK_Participacion', 'Club', 'Torneo','Temporada', 'Puntos'];
    } 
    elseif ($tablaSeleccionada == 'torneo') {
        $sql = "SELECT pk_torneo, nombre, temporada FROM Torneo;";
        $headers = ['PK_Torneo', 'Nombre', 'Temporada'];
    }
    elseif ($tablaSeleccionada == 'pais') {
        $sql = "SELECT pk_pais, nombre FROM Pais;";
        $headers = ['PK_Pais', 'Pais'];
    }
    elseif ($tablaSeleccionada == 'posicion') {
        $sql = "SELECT pk_posicion, nombre FROM Posicion;";
        $headers = ['PK_Torneo', 'Posicion'];
    }
    elseif ($tablaSeleccionada == 'usuario') {
        $sql = "SELECT usuario.id, usuario.nombre, usuario.password, tipo_usuario.tipo FROM Usuario INNER JOIN Tipo_usuario ON 
                usuario.tipo=tipo_usuario.pk_tipo;";
        $headers = ['ID','Nombre','Password', 'Tipo'];
    }

    echo "<table border='1'>
    <tr>";
    foreach ($headers as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    $mostrar = $conexion->query($sql);
    if ($mostrar->num_rows > 0) {
        while ($row = $mostrar->fetch_assoc()) {
            $pk=array_values($row)[0];
            echo "<tr>";
            foreach ($row as $column) {
                echo "<td>" . $column . "</td>";
            }
            if($user=='Administrador'){ //boton actualizar
                echo"<td> <form action='actualizar.php'method='post'>";
                echo"<button type='submit' name='dato' value=$pk>Actualizar</button>";
                echo "</form>";
                echo"</td>";
                echo"<td> <form action='eliminar.php'method='post'>"; // boton eliminar
                echo "<button type='submit' name='dato' value='$pk' onclick='return confirm(\"¿Estás seguro de eliminar este registro?\");'>Eliminar</button>";
                echo "</form>";
                echo"</td>";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
    if($user=='Administrador'){ //boton insertar
        echo"<form action='insertar.php'method='post'>";
        echo"<button type='submit'>Insertar nuevo registro</button>";
        echo "</form>";
    }
    ?>
</body>
</html>
