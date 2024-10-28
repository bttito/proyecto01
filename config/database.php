<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb+srv://Dsi4:zpESqD3OnjrdTu5s@myatlasclusteredu.ucpcp.mongodb.net/?retryWrites=true&w=majority&appName=myAtlasClusterEDU");

$database = $mongoClient->selectDatabase('inventario');
$database1 = $mongoClient->selectDatabase('usuarios');

$tasksCollection = $database->tareas;

?>