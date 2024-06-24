<?php
// search.php

// Database connection settings
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'clinica';

// Connect to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get the search query from the form
$document_number = $_POST['document_number'];

// Prepare the search query
$search_query = "SELECT documentoIdentidad, nombrePrimer FROM persona WHERE documentoIdentidad LIKE ?";

// Prepare the statement
$stmt = $conn->prepare($search_query);

// Bind the parameter
$param = "%" . $document_number . "%";
$stmt->bind_param("s", $param);

// Execute the query
$stmt->execute();

// Fetch the results
$result = $stmt->get_result();

// Prepare the HTML response
$response = '';

// Display the results
if ($result->num_rows > 0) {
    $response .= '<ul>';
    while ($row = $result->fetch_assoc()) {
        $response .= "<li>Paciente: ". $row['documentoIdentidad']. " - ". $row['nombrePrimer']. "</li>";
    }
    $response .= '</ul>';
} else {
    $response .= "<p>No se encontró paciente con el número de documento: ". $document_number. "</p>";
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Send the response
echo $response;
?>
