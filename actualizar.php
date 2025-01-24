<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
</head>
<body>
    <?php
    session_start();
    $tabla=$_SESSION['tabla'];
    $pk=$_POST['dato'];
    $_SESSION['pk']=$pk;
    include ('conexion.php');
    $bd=new BaseDeDatos($_SESSION['user'],$_SESSION['password']);
    $conexion= $bd->getConexion();

    if ($tabla == 'jugador') {
        $who="SELECT * FROM jugador where nomina=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Nombre: <input type='text' name='Nombre' value=$datos[1]><br>";
        echo "Apellido: <input type='text' name='Apellido' value=$datos[2] ><br>";
        echo "Nacionalidad: <select name='Nacionalidad'>";
        $query = $conexion->query("SELECT * FROM Pais");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Pais']==$datos[3]){
            echo '<option value="' . $valores['PK_Pais'] . '" selected>' . $valores['nombre'] . '</option>';
            }
            else{
            echo '<option value="' . $valores['PK_Pais'] . '">' . $valores['nombre'] . '</option>';
            }
        }
        echo "</select><br>";
        echo "Club: <select name='Club'>";
        echo "<option value=0>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Club");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Club']==$datos[4]){
            echo '<option value="' . $valores['PK_Club'] . '" selected>' . $valores['nombre'] . '</option>';
            }
            else{
            echo '<option value="' . $valores['PK_Club'] . '">' . $valores['nombre'] . '</option>';
            }
        }
        echo "</select>";
        echo "</select><br>";
        echo "Posicion: <select name='Posicion'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Posicion");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Posicion']==$datos[5]){
            echo '<option value="' . $valores['PK_Posicion'] . '" selected>' . $valores['nombre'] . '</option>';
                }
                else{
            echo '<option value="' . $valores['PK_Posicion'] . '">' . $valores['nombre'] . '</option>';
                }
        }
        echo "</select><br>";
        echo "<button type='submit'>Actualizar</button>";
        echo "</form>";
    } 
    elseif ($tabla == 'club') {
        $who="SELECT * FROM club WHERE PK_CLUB=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Nombre: <input type='text' name='Nombre' value=$datos[1]><br>";
        echo "Fundacion: <input type='date' name='Fundacion' value=$datos[2]><br>";
        echo "Pais: <select name='Pais'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Pais");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Pais']==$datos[3]){
            echo '<option value="' . $valores['PK_Pais'] . '" selected>' . $valores['nombre'] . '</option>';
            }
            else{
            echo '<option value="' . $valores['PK_Pais'] . '">' . $valores['nombre'] . '</option>';
            }
        }
        echo "</select><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form>";
    } 
    elseif ($tabla == 'estadistica') {
        $who="SELECT * FROM estadistica WHERE Estadistica.PK_Estadistica=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Jugador: <select name='Jugador'>";
        $query = $conexion->query("SELECT * FROM jugador");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['nomina']==$datos[1]){
                echo '<option value="' . $valores['nomina'] . '" selected>' . $valores['nombre'] . " ". $valores['apellido']. '</option>';
                }
            else{
            echo '<option value="' . $valores['nomina'] . '">' . $valores['nombre'] . '</option>';
            }
        }
        echo "</select><br>"; 
        echo "Torneo: <select name='Torneo'>";
        $query = $conexion->query("SELECT * FROM torneo");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Torneo']==$datos[2]){
                echo '<option value="' . $valores['PK_Torneo'] . '" selected>' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
                }
            else{
            echo '<option value="' . $valores['PK_Torneo'] . '">' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
            }
        }
        echo "</select><br>";
        echo "Partidos: <input type='number' name='Partidos' value=$datos[3]><br>";
        echo "Goles: <input type='number' name='Goles'value=$datos[4]><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form>";
    } 
    elseif ($tabla == 'participacion') {
        $who="SELECT * FROM participacion WHERE Participacion.PK_Participacion=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Jugador: <select name='Club'>";
        $query = $conexion->query("SELECT * FROM club");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Club']==$datos[2]){
                echo '<option value="' . $valores['PK_Club'] . '" selected>' . $valores['nombre'] . '</option>';
                }
            else{
            echo '<option value="' . $valores['PK_Club'] . '">' . $valores['nombre'] . '</option>';
            }
        }
        echo "</select><br>";
        echo "Torneo: <select name='Torneo'>";
        $query = $conexion->query("SELECT * FROM torneo");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_Torneo']==$datos[3]){
                echo '<option value="' . $valores['PK_Torneo'] . '" selected>' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
                }
            else{
            echo '<option value="' . $valores['PK_Torneo'] . '">' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
            }
        }
        echo "</select><br>";
        echo "Puntos: <input type='number' name='Puntos' value=$datos[1]><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form";
    } 
    elseif ($tabla == 'torneo') {
        $who="SELECT * FROM torneo WHERE PK_TORNEO=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Torneo: <Input type='text' name='Nombre'value=$datos[1]><br>";
        echo "Temporada: <Input type='text' name='Temporada'value=$datos[2]><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form";
    }
    elseif ($tabla == 'pais') {
        $who="SELECT * FROM pais WHERE PK_Pais=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre' value=$datos[1]><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form";
    }
    elseif ($tabla == 'posicion') {
        $who="SELECT * FROM posicion WHERE PK_Posicion=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre' value=$datos[1]><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form";
    }
    elseif ($tabla == 'usuario') {
        $who="SELECT * FROM usuario WHERE ID=$pk;";
        $actualizar=$conexion->query($who);
        $datos=mysqli_fetch_row($actualizar);
        echo "<form action='actualizar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre' value=$datos[1]><br>";
        echo "Contraseña: <Input type='text' name='Password'><br>";
        echo "Tipo: <select name='Tipo'>";
        $query = $conexion->query("SELECT * FROM tipo_usuario");
        while ($valores = mysqli_fetch_array($query)) {
            if($valores['PK_tipo']==$datos[3]){
            echo '<option value="' . $valores['PK_tipo'] . '" selected>' . $valores['Tipo'] . '</option>';
                }
            else{
            echo '<option value="' . $valores['PK_tipo'] . '">' . $valores['Tipo'] . '</option>';
            }
        }
        echo "</select><br>";
        echo "<button type='submit'> Actualizar </button>";
        echo "</form";
    }   
    ?>
</body>
</html>