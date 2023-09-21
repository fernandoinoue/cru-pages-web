<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Verificar que exista el ID del producto
if (isset($_GET['id'])) {
    // Seleccionar el registro que se va a eliminar
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$producto) {
        exit('Producto con ese ID no existe.');
    }
    // Asegurarse de que el usuario confirme antes de eliminar
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // El usuario hizo clic en el botón "Sí", eliminar el registro
            $stmt = $pdo->prepare('DELETE FROM productos WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Has eliminado el producto.';
        } else {
            // El usuario hizo clic en el botón "No", redirigir de nuevo a la página de lectura
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No se ha especificado un ID.');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete Register #<?=$producto['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete Register #<?=$producto['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$producto['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$producto['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
