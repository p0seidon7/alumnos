<?php
session_start(); 

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); 
    exit();
}

include 'conexion.php';

$query = "SELECT * FROM alumnos"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Alumnos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="titulo">Lista de Alumnos</h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Número</th>
                    <th>Matrícula</th>
                    <th>Tutor</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['numero']) ?></td>
                            <td><?= htmlspecialchars($row['matricula']) ?></td>
                            <td><?= htmlspecialchars($row['tutor']) ?></td>
                            <td><?= htmlspecialchars($row['direccion']) ?></td>
                            <td class="table-actions">
                                <a href="editar.php?matricula=<?= $row['matricula'] ?>">Editar</a>
                                <a href="borrar.php?matricula=<?= $row['matricula'] ?>">Borrar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay alumnos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="index.php"><button>Volver a Inicio</button></a>
            <a href="formulario.php"><button>Agregar Alumno</button></a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); // Cerrar la conexión ?>
