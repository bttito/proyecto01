<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = registrarUsuario($_POST['nombre'], $_POST['email'], $_POST['password']);
    if ($id) {
        header("Location: login.php?mensaje=Inicie sesion");
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
    <title>registro</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    
    <form method="POST" action="registro.php">
       <h2>REGISTRARSE</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registrarse</button>
        <a href="login.php" class="button">Iniciar sesion</a>
    </form>
    <?php
    // En registro.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    registrarUsuario($nombre, $email, $password);
    // Redirigir al usuario a una página de confirmación o al inicio de sesión
}

// En login.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = verificarUsuario($email, $password);

    if ($usuario) {
        // Iniciar sesión (por ejemplo, crear una sesión)
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: perfil.php');
    } else {
        // Mostrar un mensaje de error
        echo "Credenciales incorrectas";
    }
}
    ?>
</body>
</html>