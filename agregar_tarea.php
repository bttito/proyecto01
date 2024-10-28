<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearTarea($_POST['codigo'], $_POST['nombre'], $_POST['descripcion'],$_POST['categoria'],$_POST['proveedor'],$_POST['precioCompra'],$_POST['precioVenta'],$_POST['fechaEntrega']);
    if ($id) {
        header("Location: index.php?mensaje=Tarea creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la tarea.";
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/agregar.css">
</head>
<body>
    <div class="container">
    <h1>Agregar Nuevo Inventario</h1>
    <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
    <label>Codigo: <input type="text" name="codigo" required></label>
    <label>Nombre: <input type="text" name="nombre" required></label>
    <label>Descricion: <textarea type="text" name="descripcion" required></textarea></label>
    <label>Categoria: <input type="text" name="categoria" required></label>
    <label>Proveedor: <input type="text" name="proveedor" required></label>
    <label>precio de Compra: <input type="number" name="precioCompra" required step="0.01"></label>
    <label>precio de Venta: <input type="number" name="precioVenta" required step="0.01"></label>
    <label>Fecha de Ingreso: <input type="date" name="fechaIngreso" required></label>

    <input type="submit" value="Crear Tarea">
    </form>
    <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>
</html>