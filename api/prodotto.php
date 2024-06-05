<?php
require_once 'dbconfig.php';

// Connessione al database
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera i prodotti dal database
$sql = "SELECT id, prodotto , prezzo , image  FROM prodotti_in_vendita";
$result = $conn->query($sql);

$prodotti = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prodotti[] = $row;
    }
} else {
    die('Nessun prodotto trovato.');
}

// Restituisce i dati in formato JSON
header('Content-Type: application/json');
echo json_encode($prodotti);

// Chiudi la connessione
$conn->close();
?>