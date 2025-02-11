<?php
$servername = "localhost";
$username = "tiendajaiime";
$password = "D70p33ms";
$dbname = "tiendajaime";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Dar de baja un cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cliente_id'])) {
    $cliente_id = $_POST['cliente_id'];
    
    $sql = "DELETE FROM clientes WHERE id='$cliente_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente dado de baja con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Dar de alta un cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente registrado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todos los clientes
$clientes = $conn->query("SELECT * FROM clientes");
if (!$clientes) {
    die("Error en la consulta: " . $conn->error);
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Clientes Tienda Jaime Galvez</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: auto;
            margin-bottom: 20px;
        }
        input, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <h1>Gestión de Clientes Tienda Jaime Galvez</h1>
    <nav>| 
        <a href="gestionclientes.php">Clientes</a>
        <a href="gestionproductos.php">Productos</a> 
    </nav>
    
    <div class="form-container">
        <h2>Registrar Cliente</h2>
        <form method="post" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" required><br>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Teléfono:</label>
            <input type="text" name="telefono" required><br>
            <button type="submit">Registrar</button>
        </form>
    </div>
    
    <div class="form-container">
        <h2>Dar de Baja Cliente</h2>
        <form method="post" action="">
            <label>ID del Cliente:</label>
            <input type="text" name="cliente_id" required><br>
            <button type="submit">Dar de Baja</button>
        </form>
    </div>
    
    <div class="form-container">
        <h2>Lista de Clientes</h2>
        <table border="1" style="width: 100%; text-align: left;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
            <?php while ($row = $clientes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
