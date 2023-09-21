<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
    $email = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : '';
    $phone = isset($_POST['Precio']) ? $_POST['Precio'] : '';
    $title = isset($_POST['Cantidad']) ? $_POST['Cantidad'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO productos VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone, $title]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Añadir Productos</h2>
    <form action="create.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id">
        <label for="Nombre">Nombre:</label>
        <input type="text" name="Nombre" id="Nombre">
        <label for="Descripcion">Descripcion:</label>
        <input type="text" name="Descripcion" id="Descripcion">
        <label for="Precio">Precio:</label>
        <input type="text" name="Precio" id="Precio">
        <label for="Cantidad">Cantidad:</label>
        <input type="text" name="Cantidad" id="Cantidad">

        <input type="submit" value="Añadir">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>