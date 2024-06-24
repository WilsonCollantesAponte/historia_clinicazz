<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="../estilos/bienvenida.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <script src="../js/script.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
        exit;
    }
    $rol = $_SESSION['rol'];

    $validar = $_SESSION['user_id'];

    if ($validar == null || $validar == '') {
        header("Location: index.php");
        die();
    }
    ?>
    <script>
        const userRole = "<?php echo $rol; ?>";
    </script>

    <?php include("header_bienvenida.php"); ?>

    <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>

    <div class="main-container">
        <div class="sidebar">
            <ul id="sidebarMenu">
                Menú dinámico 
            </ul>
        </div>
        <div class="content" id="content">
            <!-- Aquí se cargará el contenido de HistoriaEmergencia.php -->
        </div>
    </div>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '../php/logout.php';
        });

        function restrictAccessByRole(role) {
            const sidebarMenu = document.getElementById('sidebarMenu');
            if (role == 1) {
                sidebarMenu.innerHTML = `
                    <li><a href="#" data-target="../section/nuevo_paciente.php">Nuevo paciente</a></li>
                    <li class="dropdown">
                        <p class="dropdown-toggle">Formatos de historias clínicas</p>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-target="../section/HistoriaEmergencia.php">Formato de emergencia</a></li>
                            <li><a href="#" data-target="../section/formato_consulta_externa.php">Formato de consulta externa</a></li>
                            <li><a href="#" data-target="../section/formato_hospitalizacion.php">Formato de hospitalización</a></li>
                            <li><a href="#" data-target="../section/ficha_familiar.php">Ficha familiar</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-target="../section/EditarHistoriaClinica.php">Registros de pacientes</a></li>
                `;
            } else if (role == 2) {
                sidebarMenu.innerHTML = `
                    <li><a href="#" data-target="../section/nuevo_paciente.php">Nuevo paciente</a></li>
                `;
            } else if (role == 3) {
                sidebarMenu.innerHTML = `
                    <li class="dropdown">
                        <p class="dropdown-toggle">Formatos de historias clínicas</p>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-target="../section/HistoriaEmergencia.php">Formato de emergencia</a></li>
                        </ul>
                    </li>
                `;
            } else if (role == 4) {
                sidebarMenu.innerHTML = `
                    <li><a href="#" data-target="../section/EditarHistoriaClinica.php">Registros de pacientes</a></li>
                `;
            }

            $('#sidebarMenu').on('click', 'a', function(event) {
                event.preventDefault();
                var targetUrl = $(this).data('target');
                if (targetUrl) {
                    $('#content').load(targetUrl);
                }
            });
        }

        restrictAccessByRole(userRole);

        // // Cargar contenido de HistoriaEmergencia.php al inicio
        // $('#content').load('../section/HistoriaEmergencia.php');
    </script>

    <div class="container-footer">
        <?php include("footer.php"); ?>
    </div>

</body>
</html>
