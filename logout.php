<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
<?php
    session_start(); 
    session_destroy(); //destruye todas las sesiones activas
    header("Location: frm_sesion.php"); //redirige
    exit();
?>
</body>
</html>