<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idPaciente']) && isset($_POST['idPersonalmedico'])) {
        $idPaciente = $_POST['idPaciente'];
        $idPersonalmedico = $_POST['idPersonalmedico'];
        
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

        // Validar que idPersonalmedico existe en la tabla personal_medico
        $queryValidarPersonal = "SELECT id FROM personal_medico WHERE id = '$idPersonalmedico'";
        $resultValidarPersonal = mysqli_query($conexion, $queryValidarPersonal);

        if (mysqli_num_rows($resultValidarPersonal) == 0) {
            echo "Error: El ID del personal médico proporcionado no existe.";
            mysqli_close($conexion);
            exit;
        }

        // Actualizar tabla persona
        $queryPersona = "UPDATE persona SET nombrePrimer='$primerNombre', nombreSegundo='$segundoNombre', 
                         apellidoPaterno='$apellidoPaterno', apellidoMaterno='$apellidoMaterno', documentoIdentidad='$dni', 
                         fechaNacimiento='$fechaNacimiento', sexo='$sexo' WHERE documentoIdentidad='$dni'";
        $resultPersona = mysqli_query($conexion, $queryPersona);

        if ($resultPersona) {
            // Actualizar tabla paciente
            $queryPaciente = "UPDATE paciente SET estadoCivil='$estadoCivil' WHERE idPersona=(SELECT id FROM persona WHERE documentoIdentidad='$dni' LIMIT 1)";
            $resultPaciente = mysqli_query($conexion, $queryPaciente);

            if ($resultPaciente) {
                // Actualizar tabla domicilio_paciente
                $queryDomicilio = "UPDATE domicilio_paciente SET departamento='$departamento', provincia='$provincia', 
                                   distrito='$distrito', localidad='$localidad', direccion='$direccion' WHERE id=(SELECT idDomicilioPaciente FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                $resultDomicilio = mysqli_query($conexion, $queryDomicilio);

                if ($resultDomicilio) {
                    // Actualizar tabla atencionobservacion
                    $evolucion = $_POST['evolucion'];
                    $queryObservacion = "UPDATE atencionobservacion SET fechaIngreso='$fechaAtencion', horaIngreso='$horaAtencion', 
                                         evolucion='$evolucion' WHERE id=(SELECT idAtencionObservacion FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                    $resultObservacion = mysqli_query($conexion, $queryObservacion);

                    if ($resultObservacion) {
                        // Actualizar tabla diagnosticoalta
                        $diagnosticoAlta = isset($_POST['diagnosticoAlta']) ? $_POST['diagnosticoAlta'] : '';
                        $tipoDxAlta = isset($_POST['tipoDxAlta']) ? $_POST['tipoDxAlta'] : '';
                        $cie10Alta = isset($_POST['cie10Alta']) ? $_POST['cie10Alta'] : '';
                        $fechaEgreso = isset($_POST['fechaEgreso']) ? $_POST['fechaEgreso'] : '';
                        $horaEgreso = isset($_POST['horaEgreso']) ? $_POST['horaEgreso'] : '';
                        $nombreResponsableAlta = isset($_POST['nombreResponsableAlta']) ? $_POST['nombreResponsableAlta'] : '';
                        $firma = isset($_POST['firma']) ? $_POST['firma'] : '';
                        $queryAlta = "UPDATE diagnosticoalta SET descripcion='$diagnosticoAlta', tipoDX='$tipoDxAlta', cie10='$cie10Alta', 
                                      fechaEgreso='$fechaEgreso', horaEgreso='$horaEgreso', nombreResponsableAlta='$nombreResponsableAlta', 
                                      firma='$firma' WHERE id=(SELECT idDiagnosticoAlta FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                        $resultAlta = mysqli_query($conexion, $queryAlta);

                        if ($resultAlta) {
                            // Actualizar tabla examenfisico
                            $frecuenciacardiaca = $_POST['frecuenciacardiaca'];
                            $frecurespiratoria = $_POST['frecurespiratoria'];
                            $temperatura = $_POST['temperatura'];
                            $presionarterial = $_POST['presionarterial'];
                            $saturacion = $_POST['saturacion'];
                            $queryExamenFisico = "UPDATE examenfisico SET frecuenciaCardiaca='$frecuenciacardiaca', 
                                                  frecuenciaRespiratoria='$frecurespiratoria', temperatura='$temperatura', 
                                                  presionArterial='$presionarterial', saturacionOxigeno='$saturacion' 
                                                  WHERE id=(SELECT idExamenFisico FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                            $resultExamenFisico = mysqli_query($conexion, $queryExamenFisico);

                            if ($resultExamenFisico) {
                                // Actualizar tabla anamnesis
                                $tiempoEnfermedad = $_POST['tiempoEnfermedad'];
                                $sintomas = $_POST['sintomas'];
                                $relato = $_POST['relato'];
                                $antecedentes = $_POST['antecedentes'];
                                $queryAnamnesis = "UPDATE anamnesis SET TiempoEnfermedad='$tiempoEnfermedad', SintomasPrincipales='$sintomas', 
                                                   Relato='$relato', Antecedentes='$antecedentes' WHERE id=(SELECT idAnamnesis FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                                $resultAnamnesis = mysqli_query($conexion, $queryAnamnesis);

                                if ($resultAnamnesis) {
                                    // Actualizar tabla destinopaciente
                                    $destinoPaciente = $_POST['destinoPaciente'];
                                    $establecimientoReferencia = $_POST['establecimiento'];
                                    $nombreResponsableAtencion = isset($_POST['nombreResponsableAtencion']) ? $_POST['nombreResponsableAtencion'] : ''; // Si corresponde al mismo nombre
                                    $queryDestino = "UPDATE destinopaciente SET destinoPaciente='$destinoPaciente', 
                                                     establecimientoReferencia='$establecimientoReferencia', 
                                                     nombreResponsableAtencion='$nombreResponsableAtencion' 
                                                     WHERE id=(SELECT idDestinoPaciente FROM historiaclinica WHERE idPaciente='$idPaciente' LIMIT 1)";
                                    $resultDestino = mysqli_query($conexion, $queryDestino);

                                    if ($resultDestino) {
                                        // Actualizar tabla historiaclinica
                                        $tipoAtencion = $_POST['tipoAtencion'];
                                        $servicio = $_POST['servicio'];
                                        $queryHistoriaClinica = "UPDATE historiaclinica SET fechaIngreso='$fechaAtencion', horaIngreso='$horaAtencion', 
                                                                 edad='$edad', tipoSeguro='$tipoAtencion', tipoServicio='$servicio', 
                                                                 idPersonalmedico='$idPersonalmedico' 
                                                                 WHERE idPaciente='$idPaciente'";
                                        $resultHistoriaClinica = mysqli_query($conexion, $queryHistoriaClinica);

                                        if ($resultHistoriaClinica) {
                                            echo "Historia clínica actualizada exitosamente.";
                                        } else {
                                            echo "Error al actualizar la historia clínica: " . mysqli_error($conexion);
                                        }
                                    } else {
                                        echo "Error al actualizar el destino del paciente: " . mysqli_error($conexion);
                                    }
                                } else {
                                    echo "Error al actualizar la anamnesis: " . mysqli_error($conexion);
                                }
                            } else {
                                echo "Error al actualizar el examen físico: " . mysqli_error($conexion);
                            }
                        } else {
                            echo "Error al actualizar el diagnóstico de alta: " . mysqli_error($conexion);
                        }
                    } else {
                        echo "Error al actualizar la observación: " . mysqli_error($conexion);
                    }
                } else {
                    echo "Error al actualizar el domicilio: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al actualizar el paciente: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al actualizar la persona: " . mysqli_error($conexion);
        }
    } else {
        echo "Error: ID del paciente o del personal médico no proporcionado.";
    }
}

mysqli_close($conexion);
?>
