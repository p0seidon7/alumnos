<?php
include 'conexion.php';

$mensaje = ""; // Variable para mensajes de éxito o error

// Procesar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $tutor = $_POST['tutor'];
    $direccion = $_POST['direccion'];

    // Comprobar si la matrícula ya existe
    $sql_check = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
    $resultado_check = $conn->query($sql_check);

    if ($resultado_check->num_rows > 0) {
        $mensaje = "Error: La matrícula ya existe.";
    } else {
        // Insertar el nuevo alumno
        $sql = "INSERT INTO alumnos (matricula, nombre, email, numero, tutor, direccion) 
                VALUES ('$matricula', '$nombre', '$email', '$numero', '$tutor', '$direccion')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Alumno añadido correctamente.";
        } else {
            $mensaje = "Error al añadir el alumno: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Alumno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <?php if ($mensaje): ?>
            <div class="alert"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <h2>Agregar Alumno</h2>
        <form method="POST" action="">
            <label for="matricula">Matrícula:</label>
            <input type="number" id="matricula" name="matricula" required pattern="[0-9]+" title="Solo se permiten números">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="numero">Número de Teléfono:</label>
            <input type="number" id="numero" name="numero" required pattern="[0-9]+" title="Solo se permiten números">

            <label for="tutor">Tutor:</label>
            <input type="text" id="tutor" name="tutor" required>

            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="direccion" required></textarea>

            <button type="submit">Agregar Alumno</button>
        </form>

        <div class="button-container">
            <a href="index.php"><button>Volver al Inicio</button></a>
            <a href="mostrar.php"><button>Mostrar Alumnos</button></a>
        </div>
    </div>
</body>
</html>
