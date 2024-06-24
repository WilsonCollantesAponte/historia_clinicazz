<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $fechaAtencion = $_POST['fechaAtencion'];
    $horaAtencion = $_POST['horaAtencion'];
    $primerNombre = $_POST['primerNombre'];
    $segundoNombre = $_POST['segundoNombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $dni = $_POST['dni'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $estadoCivil = $_POST['estadoCivil'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $idPersonalmedico = $_POST['idPersonalmedico'];
    $evolucion = $_POST['evolucion'];
    $diagnosticoAlta = isset($_POST['diagnosticoAlta']) ? $_POST['diagnosticoAlta'] : '';
    $tipoDxAlta = isset($_POST['tipoDxAlta']) ? $_POST['tipoDxAlta'] : '';
    $cie10Alta = isset($_POST['cie10Alta']) ? $_POST['cie10Alta'] : '';
    $fechaEgreso = $_POST['fechaEgreso'];
    $horaEgreso = $_POST['horaEgreso'];
    $nombreResponsableAlta = $_POST['nombreResponsableAlta'];
    $firma = isset($_POST['firma']) ? $_POST['firma'] : '';
    $frecuenciacardiaca = $_POST['frecuenciacardiaca'];
    $frecurespiratoria = $_POST['frecurespiratoria'];
    $temperatura = $_POST['temperatura'];
    $presionarterial = $_POST['presionarterial'];
    $saturacion = $_POST['saturacion'];
    $tiempoEnfermedad = $_POST['tiempoEnfermedad'];
    $sintomas = $_POST['sintomas'];
    $relato = $_POST['relato'];
    $antecedentes = $_POST['antecedentes'];
    $destinoPaciente = $_POST['destinoPaciente'];
    $establecimientoReferencia = $_POST['establecimiento'];
    $tipoAtencion = $_POST['tipoAtencion'];
    $servicio = $_POST['servicio'];
    $diagnostico = $_POST['diagnostico'];
    $tipo = $_POST['tipo'];
    $cie10 = $_POST['cie10'];
    $parentesco = $_POST['parentesco'];

    // Validar que idPersonalmedico existe en la tabla personal_medico
    $queryValidarPersonal = "SELECT id FROM personal_medico WHERE id = '$idPersonalmedico'";
    $resultValidarPersonal = mysqli_query($conexion, $queryValidarPersonal);

    if (mysqli_num_rows($resultValidarPersonal) == 0) {
        echo "Error: El ID del personal médico proporcionado no existe.";
        mysqli_close($conexion);
        exit;
    }

    // Transacción para asegurar la consistencia de los datos
    mysqli_begin_transaction($conexion);

    try {
        // Insertar datos en la tabla persona
        $queryPersona = "INSERT INTO persona (nombrePrimer, nombreSegundo, apellidoPaterno, apellidoMaterno, documentoIdentidad, fechaNacimiento, sexo) 
                         VALUES ('$primerNombre', '$segundoNombre', '$apellidoPaterno', '$apellidoMaterno', '$dni', '$fechaNacimiento', '$sexo')";
        if (!mysqli_query($conexion, $queryPersona)) {
            throw new Exception("Error al guardar la persona: " . mysqli_error($conexion));
        }
        $idPersona = mysqli_insert_id($conexion);

        // Insertar datos en la tabla paciente
        $queryPaciente = "INSERT INTO paciente (estadoCivil, historialMedico, idPersona) 
                          VALUES ('$estadoCivil', '', '$idPersona')";
        if (!mysqli_query($conexion, $queryPaciente)) {
            throw new Exception("Error al guardar el paciente: " . mysqli_error($conexion));
        }
        $idPaciente = mysqli_insert_id($conexion);

        // Insertar datos en la tabla domicilio_paciente
        $queryDomicilio = "INSERT INTO domicilio_paciente (departamento, provincia, distrito, localidad, direccion) 
                           VALUES ('$departamento', '$provincia', '$distrito', '$localidad', '$direccion')";
        if (!mysqli_query($conexion, $queryDomicilio)) {
            throw new Exception("Error al guardar el domicilio: " . mysqli_error($conexion));
        }
        $idDomicilioPaciente = mysqli_insert_id($conexion);

        // Insertar datos en la tabla atencionobservacion
        $queryObservacion = "INSERT INTO atencionobservacion (fechaIngreso, horaIngreso, evolucion) 
                             VALUES ('$fechaAtencion', '$horaAtencion', '$evolucion')";
        if (!mysqli_query($conexion, $queryObservacion)) {
            throw new Exception("Error al guardar la observación: " . mysqli_error($conexion));
        }
        $idObservacion = mysqli_insert_id($conexion);

        // Insertar datos en la tabla diagnosticoalta
        $queryAlta = "INSERT INTO diagnosticoalta (idObservacion, descripcion, tipoDX, cie10, fechaEgreso, horaEgreso, nombreResponsableAlta, firma) 
                      VALUES ('$idObservacion', '$diagnosticoAlta', '$tipoDxAlta', '$cie10Alta', '$fechaEgreso', '$horaEgreso', '$nombreResponsableAlta', '$firma')";
        if (!mysqli_query($conexion, $queryAlta)) {
            throw new Exception("Error al guardar el diagnóstico de alta: " . mysqli_error($conexion));
        }
        $idDiagnosticoAlta = mysqli_insert_id($conexion);

        // Insertar datos en la tabla examenfisico
        $queryExamenFisico = "INSERT INTO examenfisico (frecuenciaCardiaca, frecuenciaRespiratoria, temperatura, presionArterial, saturacionOxigeno) 
                              VALUES ('$frecuenciacardiaca', '$frecurespiratoria', '$temperatura', '$presionarterial', '$saturacion')";
        if (!mysqli_query($conexion, $queryExamenFisico)) {
            throw new Exception("Error al guardar el examen físico: " . mysqli_error($conexion));
        }
        $idExamenFisico = mysqli_insert_id($conexion);

        // Insertar datos en la tabla anamnesis
        $queryAnamnesis = "INSERT INTO anamnesis (idExamenFisico, TiempoEnfermedad, SintomasPrincipales, Relato, Antecedentes) 
                           VALUES ('$idExamenFisico', '$tiempoEnfermedad', '$sintomas', '$relato', '$antecedentes')";
        if (!mysqli_query($conexion, $queryAnamnesis)) {
            throw new Exception("Error al guardar la anamnesis: " . mysqli_error($conexion));
        }
        $idAnamnesis = mysqli_insert_id($conexion);

        // Insertar datos en la tabla destinopaciente
        $queryDestino = "INSERT INTO destinopaciente (destinoPaciente, establecimientoReferencia, nombreResponsableAtencion) 
                         VALUES ('$destinoPaciente', '$establecimientoReferencia', '$nombreResponsableAlta')";
        if (!mysqli_query($conexion, $queryDestino)) {
            throw new Exception("Error al guardar el destino del paciente: " . mysqli_error($conexion));
        }
        $idDestinoPaciente = mysqli_insert_id($conexion);

        // Insertar datos en la tabla impresiondiagnostica primero
        $queryDiagnostica = "INSERT INTO impresiondiagnostica (descripcion, tipoDX, cie10, examenesAuxiliares, tratamiento) 
                             VALUES ('$diagnostico', '$tipo', '$cie10', '', '')";
        if (!mysqli_query($conexion, $queryDiagnostica)) {
            throw new Exception("Error al guardar la impresión diagnóstica: " . mysqli_error($conexion));
        }
        $idImpresionDiagnostica = mysqli_insert_id($conexion);

        // Insertar datos en la tabla historia_clinica usando el idImpresionDiagnostica
        $queryHistoriaClinica = "INSERT INTO historiaclinica (fechaIngreso, horaIngreso, edad, tipoSeguro, tipoServicio, idPaciente, idPersonalmedico, idDomicilioPaciente, idDiagnosticoAlta, idAnamnesis, idDestinoPaciente, idAtencionObservacion, idExamenFisico, idImpresionDiagnostica) 
                                 VALUES ('$fechaAtencion', '$horaAtencion', '$edad', '$tipoAtencion', '$servicio', '$idPaciente', '$idPersonalmedico', '$idDomicilioPaciente', '$idDiagnosticoAlta', '$idAnamnesis', '$idDestinoPaciente', '$idObservacion', '$idExamenFisico', '$idImpresionDiagnostica')";
        if (!mysqli_query($conexion, $queryHistoriaClinica)) {
            throw new Exception("Error al guardar la historia clínica: " . mysqli_error($conexion));
        }

        // Insertar datos en la tabla acompañante
        $queryAcompanante = "INSERT INTO acompanante (nombrePrimer,nombreSegundo,apellidoPaterno,apellidoMaterno,contacto,parentesco, idPersona) 
                             VALUES ('$nombrePrimer', '$nombreSegundo', '$apellidoPaterno', '$apellidoMaterno', '$parentesco', '$idPersona')";
        if (!mysqli_query($conexion, $queryAcompanante)) {
            throw new Exception("Error al guardar el acompañante: " . mysqli_error($conexion));
        }

        // Confirmar la transacción
        mysqli_commit($conexion);

        echo "Historia clínica guardada exitosamente.";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($conexion);
        echo $e->getMessage();
    }
}

mysqli_close($conexion);
?>
