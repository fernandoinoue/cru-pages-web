<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Verificar si existe el ID del producto
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Obtener los datos del formulario
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';
        // Actualizar el registro
        $stmt = $pdo->prepare('UPDATE productos SET id = ?, nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?');
        $stmt->execute([$id, $nombre, $descripcion, $precio, $cantidad, $_GET['id']]);
        $msg = '¡Actualizado con éxito!';
    }
    // Obtener el producto de la tabla productos
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$producto) {
        exit('Producto con ese ID no existe.');
    }
} else {
    exit('No se ha especificado un ID.');
}
?>

<?=template_header('Update')?>

<div class="content update">
    <h2>Actualizar Producto #<?=$producto['id']?></h2>
    <form action="update.php?id=<?=$producto['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?=$producto['id']?>" id="id">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre del producto" value="<?=$producto['nombre']?>" id="nombre">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" placeholder="Descripción del producto" value="<?=$producto['descripcion']?>" id="descripcion">
        <label for="precio">Precio</label>
        <input type="text" name="precio" placeholder="100.00" value="<?=$producto['precio']?>" id="precio">
        <label for="cantidad">Cantidad</label>
        <input type="text" name="cantidad" placeholder="10" value="<?=$producto['cantidad']?>" id="cantidad">        
        <input type="submit" value="Actualizar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
