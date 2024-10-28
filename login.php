<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = verificarUsuario($_POST['email'], $_POST['password']);
    if ($id) {
        header("Location: index.php?mensaje=Inicio de sesion exitoso");
        exit;
    } else {
        $error = "No se pudo iniciar sesion.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
    <form method="POST" action="login.php">
    <h2>Iniciar Sesión</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesión</br>
       
    </form>
    <a href="registro.php" class="bu">Registrarse</a>
</body>
</html>