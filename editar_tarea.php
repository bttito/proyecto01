<?php
require_once __DIR__ . '/includes/functions.php';
//Verificacion del ID de la tarea

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
//Obtencion de la tarea
$tarea = obtenerTareaPorId($_GET['id']);

if (!$tarea) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarTarea($_GET['id'], $_POST['codigo'], $_POST['nombre'], $_POST['descripcion'],$_POST['categoria'],$_POST['proveedor'],$_POST['precioCompra'],$_POST['precioVenta'],$_POST['fechaIngreso']);
    if ($count > 0) {
        header("Location: index.php?mensaje=Tarea actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la tarea.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <div class="container">
        <h1>Editar Inventario</h1>
        <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
<form method="POST">
        <label>Codigo: <input type="text" name="codigo" value="<?php echo htmlspecialchars($tarea['codigo']); ?>" required></label>
        <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($tarea['nombre']); ?>" required></label>
        <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea></label>
        <label>Categoria: <input type="text" name="categoria" value="<?php echo htmlspecialchars($tarea['categoria']); ?>" required></label>
        <label>Proveedor: <input type="text" name="proveedor" value="<?php echo htmlspecialchars($tarea['proveedor']); ?>" required></label>
        <label>Precio de Compra: <input type="number" name="precioCompra" value="<?php echo htmlspecialchars($tarea['precioCompra']); ?>" required></label>
        <label>Precio de Venta: <input type="number" name="precioVenta" value="<?php echo htmlspecialchars($tarea['precioVenta']); ?>" required></label>
        <label>Fecha de Ingreso: <input type="date" name="fechaIngreso" value="<?php echo formatDate($tarea['fechaIngreso']); ?>" required></label>
        <input type="submit" value="Actualizar Tarea">
</form>

<a href="index.php" class="button">Volver a la lista de inventarios</a>

</div>
</body>
</html>
