<?php
include 'conexion.php';

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    $sql = "DELETE FROM alumnos WHERE matricula = '$matricula'";

    if ($conn->query($sql) === TRUE) {
        header("Location: mostrar.php?mensaje=Alumno eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el alumno: " . $conn->error;
    }
} else {
    header("Location: mostrar.php?mensaje=Matrícula no recibida");
    exit();
}

$conn->close();
?>
