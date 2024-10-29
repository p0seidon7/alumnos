<?php
include 'conexion.php';

$matricula = $_GET['matricula'];
$mensaje = "";

// Obtener datos del alumno para editar
$sql = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
$resultado = $conn->query($sql);
$alumno = $resultado->fetch_assoc();

// Procesar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $tutor = $_POST['tutor'];
    $direccion = $_POST['direccion'];

    // Actualizar los datos del alumno
    $sql_update = "UPDATE alumnos SET nombre='$nombre', email='$email', numero='$numero', tutor='$tutor', direccion='$direccion' WHERE matricula='$matricula'";

    if ($conn->query($sql_update) === TRUE) {
        $mensaje = "Alumno actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar el alumno: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <?php if ($mensaje): ?>
            <div class="alert"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <h2>Editar Alumno</h2>
        <form method="POST" action="">
            <label for="matricula">Matrícula:</label>
            <input type="number" id="matricula" name="matricula" value="<?= $alumno['matricula'] ?>" readonly required pattern="[0-9]+" title="Solo se permiten números">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($alumno['nombre']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($alumno['email']) ?>" required>

            <label for="numero">Número de Teléfono:</label>
            <input type="number" id="numero" name="numero" value="<?= $alumno['numero'] ?>" required pattern="[0-9]+" title="Solo se permiten números">

            <label for="tutor">Tutor:</label>
            <input type="text" id="tutor" name="tutor" value="<?= htmlspecialchars($alumno['tutor']) ?>" required>

            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="direccion" required><?= htmlspecialchars($alumno['direccion']) ?></textarea>

            <button type="submit">Actualizar Alumno</button>
        </form>

        <div class="button-container">
            <a href="index.php"><button>Volver al Inicio</button></a>
            <a href="mostrar.php"><button>Mostrar Alumnos</button></a>
        </div>
    </div>
</body>
</html>
