<?php

require 'database.php';

$con = new Database();
$pdo = $con->conectar();

$campo = $_POST["search-input"];

$sql = "SELECT documentoIdentidad, nombrePrimer, apellidoPaterno, apellidoMaterno FROM persona WHERE documentoIdentidad LIKE ? ORDER BY documentoIdentidad ASC;
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%', $campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li onclick=\"mostrar('" . $row["documentoIdentidad"] . "')\">" . $row["nombrePrimer"] . " - " . $row["ApellidoPaterno"] .  " - " . $row["ApellidoMaterno"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);