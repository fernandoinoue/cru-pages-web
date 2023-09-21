<?php
function pdo_connect_mysql() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ventas";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "";
        return $conn;
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
}

function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>$title</title>
            <link href="style.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">        
        </head>
        <body>
        <nav class="navtop">
            <div>
                <h1>CRUD-PHP & MYSQL</h1>
                <a href="index.php"><i class="fas fa-home"></i>Home</a>
                <a href="read.php"><i class="fa fa-upload" aria-hidden="true"></i>Register</a>
            </div>
        </nav>
    EOT;
}
function template_footer() {
    echo <<<EOT
        </body>
    </html>
    EOT;
}
?>