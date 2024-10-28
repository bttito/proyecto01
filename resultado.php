<?php
require_once __DIR__ . '/includes/functions.php';

// Obtener el código del producto a buscar desde la URL
$codigo = $_GET['codigo'];

// Buscar el producto
$producto = buscarTareaPorCodigo($codigo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="css/resultado.css"> </head>
<body>
    <div class="container">
        <h2>Detalles del Producto</h2>
        <?php if ($producto) { ?>
            <table>
                <tr class="color">
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcíon</th>
                    <th>Categoria</th>
                    <th>Proveedor</th>
                    <th>Precio de Compra</th>
                    <th>Precio de Venta</th>
                    <th>Fecha de Ingreso</th>
                </tr>
                <tr>
                    <th><?php echo $producto['codigo']; ?></th>
                    <th><?php echo $producto['nombre']; ?></th>
                    <th><?php echo $producto['descripcion']; ?></th>
                    <th><?php echo $producto['categoria']; ?></th>
                    <th><?php echo $producto['proveedor']; ?></th>
                    <th><?php echo $producto['precioCompra']; ?></th>
                    <th><?php echo $producto['precioVenta']; ?></th>
                    <th><?php echo formatDate($producto['fechaIngreso']); ?></th>
                </tr>


                </table>
        <?php } else { ?>
            <p>Producto no encontrado.</p>
        <?php } ?>
        <a href="index.php" class="button">Volver a la lista de inventarios</a>
    </div>
</body>
</html>