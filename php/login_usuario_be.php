<?php
session_start();
include "conexion_be.php";

$codigoi = $_POST["codigo"];
$passi = $_POST["pass"];

$validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE codigo = '$codigoi' and password='$passi'");

$filas = mysqli_fetch_array($validar_login);

if ($filas) {
    $_SESSION['user_id'] = $filas['id'];
    $_SESSION['rol'] = $filas['id_cargo']; // Guarda el rol del usuario en la sesión
    
    header("Location: ../section/bienvenida.php");
    exit;
} else {
    echo '  
    <script>
        alert("Datos ingresados no registrados en el sistema, Comunicate con un asesor para solucionar el problema");
        window.location="../section/index.php";
    </script>
    ';
    exit;
}
?>
