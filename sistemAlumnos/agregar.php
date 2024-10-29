<?php
include 'conexion.php';

$mensaje = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $tutor = $_POST['tutor'];
    $direccion = $_POST['direccion'];

    // Verificar si la matrícula ya existe
    $check_sql = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $mensaje = "Error: La matrícula <b>$matricula</b> ya está registrada.";
        $error = true;
    } else {
        // Insertar nuevo alumno
        $sql = "INSERT INTO alumnos (matricula, nombre, email, numero, tutor, direccion)
                VALUES ('$matricula', '$nombre', '$email', '$numero', '$tutor', '$direccion')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Alumno añadido correctamente.";
        } else {
            $mensaje = "Error: " . $conn->error;
            $error = true;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('img2.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .message-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro y transparente */
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .message-container h2 {
            color: <?= $error ? '#ff4c4c' : '#4caf50' ?>; /* Rojo para errores, verde para éxito */
            margin-bottom: 20px;
        }

        .message-container a button {
            width: 100%;
            padding: 15px;
            margin-top: 10px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
        }

        .message-container a button:hover {
            background-color: #5a5a5a;
            transform: scale(1.05);
        }

        .message-container a {
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h2><?= $mensaje ?></h2>
        <a href="index.php"><button>Volver al Inicio</button></a>
        <?php if (!$error): ?>
            <a href="formulario.php"><button>Agregar Otro Alumno</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
