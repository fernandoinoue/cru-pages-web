<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<!-- <?=template_header('Home')?> -->

<!-- <div class="content">
	<h2>Home</h2>
	<p>Welcome to the home page!</p>
</div> -->
<?=template_header('Home')?>

<div class="content">
    <h2>Home</h2>
    <p>Welcome to the home page CRUD!</p>
</div>

<div class="content read">
	<h2>Read Register</h2>
	<a href="create.php" style="display: block;background-color: #38b673;border: 0;font-weight: bold;font-size: 1em;color: #FFFFFF;cursor: pointer;
    width: 205px; margin-top: 15px; text-align: center; padding: 6px; border-radius: 8px; letter-spacing: 0.05em; text-decoration: none; font-family: Arial, sans-serif;">
    <i class="fa fa-user"></i> Create New Register</a>
</div>





<div class="content">
    <h2>Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pdo = pdo_connect_mysql();
            $stmt = $pdo->query('SELECT * FROM productos');
            foreach ($stmt as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['descripcion']}</td>";
                echo "<td>{$row['precio']}</td>";
                echo "<td>{$row['cantidad']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>

