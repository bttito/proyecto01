<?php
require_once __DIR__ . '/../config/database.php';
//Esta funcion limpia los datos ingresados por el usuario
function sanitizeInput($input){
    return htmlspecialchars(strip_tags(trim($input)));
}
//Formatear fechas
function formatDate($date){
   return $date->toDateTime()->format('y-m-d');
}
//Funcion para crear una tarea
function crearTarea($codigo , $nombre , $descripcion , $categoria , $proveedor ,$precioCompra ,$precioVenta , $fechaIngreso){
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'codigo' => sanitizeInput($codigo),
        'nombre' => sanitizeInput($nombre),
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'proveedor' => sanitizeInput($proveedor),
        'precioCompra' => sanitizeInput($precioCompra),
        'precioVenta' => sanitizeInput($precioVenta),
        
        'fechaIngreso' =>new MongoDB\BSON\UTCDateTime(strtotime($fechaIngreso) * 1000)
    ]);
   return $resultado->getInsertedId();
}
//Funcion para oobtener todas las tareas
function obtenerTareas(){
  global $tasksCollection;
  return $tasksCollection->find();
}
//Funcion para obtener una tarea especifica
function obtenerTareaPorId($id){
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

//funcion para actulizar una tarea
function actualizarTarea($id ,$codigo , $nombre , $descripcion , $categoria , $proveedor ,$precioCompra ,$precioVenta , $fechaIngreso){
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'codigo' => sanitizeInput($codigo),
            'nombre' => sanitizeInput($nombre),
            'descripcion' => sanitizeInput($descripcion),
            'categoria' => sanitizeInput($categoria),
            'proveedor' => sanitizeInput($proveedor),
            'precioCompra' => sanitizeInput($precioCompra),
            'precioVenta' => sanitizeInput($precioVenta),

            'fechaIngreso' => new MongoDB\BSON\UTCDateTime(strtotime($fechaIngreso) * 1000)
        ]]
    );
    return $resultado->getModifiedCount();

}
//Funcion para eliminar una tarea
function eliminarTarea($id){
   global $tasksCollection;
   $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
   return $resultado->getDeletedCount();
}
// Función para buscar tareas por código
function buscarTareaPorCodigo($codigo) {
    global $tasksCollection;
    return $tasksCollection->findOne(['codigo' => $codigo]);
}


// Función para registrar un nuevo usuario
function registrarUsuario($nombre, $email, $password) {
    global $database1;
    $usuariosCollection = $database1->usuarios;

    // Hashear la contraseña antes de guardarla
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $resultado = $usuariosCollection->insertOne([
        'nombre' => $nombre,
        'email' => $email,
        'password' => $passwordHash
    ]);

    return $resultado->getInsertedId();
}


// Función para verificar las credenciales de un usuario
function verificarUsuario($email, $password) {
    global $database1;
    $usuariosCollection = $database1->usuarios;

    $usuario = $usuariosCollection->findOne(['email' => $email]);

    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    } else {
        return false;
    }
}
?>
