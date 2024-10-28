<?php
require_once __DIR__ . '/includes/functions.php';
//Manejo de eliminacion de tareas
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarTarea($_GET['id']);
    $mensaje = $count > 0 ? "Tarea eliminada con éxito." : "No se pudo eliminar la tarea.";
}
//Obtencion de todas las tareas
$tareas = obtenerTareas();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="container">
    <h1>Gestión de Inventario</h1>

    <?php if (isset($mensaje)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <a href="agregar_tarea.php" class="button">Agregar Nuevo Inventario</a><br>
    <label>Buscar Producto :</label>
    <form class="search-form" method="GET" action="resultado.php">
    <input type="text" name="codigo" placeholder="Buscar por código">
    <button type="submit">Buscar</button>
</form>

    <h2>Lista de Inventarios</h2>
    <!-- ... -->
    <table>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Descripcíon</th>
        <th>Categoria</th>
        <th>Proveedor</th>
        <th>Precio de Compra</th>
        <th>Precio de Venta</th>
        <th>Fecha de Ingreso</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($tareas as $tarea): ?>
    <tr>
        <td><?php echo htmlspecialchars($tarea['codigo']); ?></td>
        <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
        <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
        <td><?php echo htmlspecialchars($tarea['categoria']); ?></td>
        <td><?php echo htmlspecialchars($tarea['proveedor']); ?></td>
        <td><?php echo htmlspecialchars($tarea['precioCompra']); ?></td>
        <td><?php echo htmlspecialchars($tarea['precioVenta']); ?></td>
        <td><?php echo formatDate($tarea['fechaIngreso']); ?></td>

        <td class="actions">
            <a href="editar_tarea.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
            <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>