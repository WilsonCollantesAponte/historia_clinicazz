<?php

include "conexion_be.php";

// Función para validar campos de texto
function validarCampo($campo) {
    return isset($campo) && trim($campo) !== '';
}

$errores = [];

// Validar campos
if (!validarCampo($_POST['primerNombre'])) {
    $errores[] = "El primer nombre no puede estar vacío o contener solo espacios.";
}

// if (!validarCampo($_POST['segundoNombre'])) {
//     $errores[] = "El segundo nombre no puede estar vacío o contener solo espacios.";
// 

if (!validarCampo($_POST['apellidoPaterno'])) {
    $errores[] = "El apellido paterno no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['apellidoMaterno'])) {
    $errores[] = "El apellido materno no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['documentoIdentidad'])) {
    $errores[] = "El documento de identidad no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['historial'])) {
    $errores[] = "El historial médico no puede estar vacío o contener solo espacios.";
}

// Si hay errores, mostrar mensajes de error con una alerta
if (!empty($errores)) {
    echo '<script>';
    echo 'alert("Se encontraron los siguientes errores: \n' . implode('\n', $errores) . '");';
    echo 'window.history.back();';
    echo '</script>';
    exit();
}

// Obtener valores del formulario
$primer = $_POST ["primerNombre"];
$segundo = $_POST ["segundoNombre"];
$paterno = $_POST ["apellidoPaterno"];
$materno = $_POST ["apellidoMaterno"];
$identidad = $_POST ["identidad"];
$grupoSanguineo = $_POST ["grupoSanguineo"];
$documentoIdentidad = $_POST ["documentoIdentidad"];
$estadoCivil = $_POST ["estadoCivil"];

$fecha = $_POST ["fecha"];
$generoForm = $_POST ["genero"];
$historial = $_POST ["historial"];
$genero = $generoForm == "masculino" ? "M" : "F";

// Verificar si el documento de identidad ya está registrado
$verificar_documento = mysqli_query($conexion, "SELECT * FROM clinica.persona WHERE documentoIdentidad='$documentoIdentidad'");
if (mysqli_num_rows($verificar_documento) > 0) {
    echo '
      <script>
        alert("Este Documento de identidad ya está registrado. Por favor verifique que los datos sean correctos.");
        window.location="../section/bienvenida.php";
      </script>
    ';  
    exit();
}

// Insertar datos en la tabla persona
$query = "INSERT INTO clinica.persona
(
nombrePrimer,
nombreSegundo,
apellidoPaterno,
apellidoMaterno,
fechaNacimiento,
tipoDoumento,
documentoIdentidad,
sexo,
grupoSanguineo)
VALUES
(
'$primer',
'$segundo',
'$paterno',
'$materno',
'$fecha',
'$identidad',
'$documentoIdentidad',
'$genero',
'$grupoSanguineo'
)";
$registrar = mysqli_query($conexion, $query);

// Obtener el id de la persona recién insertada
$id = 0;
$queryBusquedaPaciente = "SELECT persona.id
FROM clinica.persona WHERE documentoIdentidad='$documentoIdentidad'";
$registrar = mysqli_query($conexion, $queryBusquedaPaciente);   

if (mysqli_num_rows($registrar) > 0) {
    while ($fila = mysqli_fetch_assoc($registrar)) {
        $id = $fila['id'];
    }
}

// Insertar datos en la tabla paciente
$queryPaciente = "INSERT INTO clinica.paciente
(
estadoCivil,

historialMedico,
idPersona)
VALUES
(
'$estadoCivil',

'$historial',
'$id'
)";
$registrar2 = mysqli_query($conexion, $queryPaciente);

// Redirigir a la página de bienvenida
header("location:../section/bienvenida.php");
?>
