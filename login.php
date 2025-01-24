<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
<?php
    session_start();
    include ('conexion.php');
    if (isset($_SESSION['user'])) { //verifica que exista una sesion con los datos
        $user = $_SESSION['user'];
        $password = $_SESSION['password'];
    } else { //si no, settea los datos de user y password en la sesion
        $user = $_POST['user'];
        $password = $_POST['password'];
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
    }
    $bd = new BaseDeDatos('Cliente', '123'); //conexion con la bd
    $conexion = $bd->getConexion();  
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    $sql= "SELECT Nombre, Password,Tipo from usuario WHERE nombre='$user' AND Password=SHA1('$password');";
    $verificar=$conexion->query($sql);
    if ($verificar->num_rows > 0) {
        $row = $verificar->fetch_array(MYSQLI_ASSOC);
        if($row['Tipo']==1){
            $_SESSION['user']='Administrador';
        }elseif($row['Tipo']==2){
            $_SESSION['user']='Cliente';
        }
        $_SESSION['password']='123'; //guarda el tipo de usuario
        $_SESSION['nombre'] = $row['Nombre'];
        header("Location: mostrar.php");
    }
    else {
        session_destroy();
        // Redirige al usuario a la página de login con un mensaje de error
        header("Location: frm_sesion.php?error");
        exit();
    }
?>
</body>
</html>