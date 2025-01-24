<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar</title>
</head>
<body>
    <?php
    session_start();
    $tabla=$_SESSION['tabla'];
    include ('conexion.php');
    $bd=new BaseDeDatos($_SESSION['user'],$_SESSION['password']);
    $conexion= $bd->getConexion();

    if ($tabla == 'jugador') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Nombre: <input type='text' name='Nombre'><br>";
        echo "Apellido: <input type='text' name='Apellido'><br>";
        echo "Nacionalidad: <select name='Nacionalidad'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Pais");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Pais'] . '">' . $valores['nombre'] . '</option>';
        }
        echo "</select><br>";
        echo "Club: <select name='Club'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Club");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Club'] . '">' . $valores['nombre'] . '</option>';
        }
        echo "</select>";
        echo "</select><br>";
        echo "Posicion: <select name='Posicion'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Posicion");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Posicion'] . '">' . $valores['nombre'] . '</option>';
        }
        echo "</select><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form>";
    } 
    elseif ($tabla == 'club') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Nombre: <input type='text' name='Nombre'><br>";
        echo "Fundacion: <input type='date' name='Fundacion'><br>";
        echo "Pais: <select name='Pais'>";
        echo "<option value='0'>Seleccione:</option>";
        $query = $conexion->query("SELECT * FROM Pais");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Pais'] . '">' . $valores['nombre'] . '</option>';
        }
        echo "</select><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form>";
    } 
    elseif ($tabla == 'estadistica') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Jugador: <select name='Jugador'>";
        $query = $conexion->query("SELECT * FROM jugador");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['nomina'] . '">' . $valores['nombre'] . " ". $valores['apellido']. '</option>';
        }
        echo "</select><br>";
        
        echo "Torneo: <select name='Torneo'>";
        $query = $conexion->query("SELECT * FROM torneo");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Torneo'] . '">' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
        }
        echo "</select><br>";
        
        echo "Partidos: <input type='number' name='Partidos'><br>";
        echo "Goles: <input type='number' name='Goles'><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form>";
    } 
    elseif ($tabla == 'participacion') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Jugador: <select name='Club'>";
        $query = $conexion->query("SELECT * FROM club");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Club'] . '">' . $valores['nombre'] . '</option>';
        }
        echo "</select><br>";
        
        echo "Torneo: <select name='Torneo'>";
        $query = $conexion->query("SELECT * FROM torneo");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_Torneo'] . '">' . $valores['nombre'] .' '. $valores['temporada']. '</option>';
        }
        echo "</select><br>";
        echo "Puntos: <input type='number' name='Puntos'><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form";
    } 
    elseif ($tabla == 'torneo') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Torneo: <Input type='text' name='Nombre'><br>";
        echo "Temporada: <Input type='text' name='Temporada'><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form";
    }    
    elseif ($tabla == 'pais') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre'><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form";
    }    
    elseif ($tabla == 'posicion') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre'><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form";
    }    
    elseif ($tabla == 'usuario') {
        echo "<form action='insertar2.php' method='post'>";
        echo "Nombre: <Input type='text' name='Nombre'><br>";
        echo "Contraseña: <Input type='text' name='Password'><br>";
        echo "Tipo: <select name='Tipo'>";
        $query = $conexion->query("SELECT * FROM tipo_usuario");
        while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="' . $valores['PK_tipo'] . '">' . $valores['Tipo'] . '</option>';
        }
        echo "</select><br>";
        echo "<button type='submit'> Insertar </button>";
        echo "</form";
    }
    ?>
</body>
</html>