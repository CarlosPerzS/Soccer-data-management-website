<!DOCTYPE html>
<html lang="es">
    <h1 style="background-color: black;"></h1>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color:beige; /* Color de fondo */
            color: red; /* Color del texto */
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;

        }
        h1 {
            background-color: lightsteelblue;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 0;
        }
        form {
            color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 0%;
            text-align: center;
        }
        button {
            color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 20px; /* Tamaño del texto */
            width: 160px; /* Ancho fijo */
            height: 40px; /* Alto fijo */
        }
    </style>
</head>
    <body>
    <h1>Iniciar sesión</h1>
    
        <?php
        if (isset($_GET['error'])) {
            echo "Usuario o contraseña incorrectos. Inténtalo nuevamente.";
        }
        ?>
        <form action="login.php" METHOD="POST">
            Usuario: <input type="text" name="user"><br>
            Contraseña: <input type="password" name="password"><br>
            <button type="submit">Ingresar</button>
        </form>
    </body>
</HTML>