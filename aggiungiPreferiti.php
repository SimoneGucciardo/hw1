<?php
require_once 'auth.php';
require_once 'dbconfig.php';

if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

header('Content-Type: application/json');

// Crea la connessione al database
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Funzione per aggiungere ai preferiti
function aggiungiAiPreferiti($conn, $id_utente, $id_prodotto) {
    $response = [];

    // Sanitize input
    $id_utente = $conn->real_escape_string($id_utente);
    $id_prodotto = $conn->real_escape_string($id_prodotto);

    // Controlla se il prodotto è già nei preferiti
    $sql = "SELECT * FROM preferiti WHERE id_utente = '$id_utente' AND id_prodotto = '$id_prodotto'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Aggiungi ai preferiti
        $sql = "INSERT INTO preferiti (id_utente, id_prodotto) VALUES ('$id_utente', '$id_prodotto')";
        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Prodotto aggiunto ai preferiti!";
        } else {
            $response['success'] = false;
            $response['message'] = "Errore nell'aggiunta ai preferiti: " . $conn->error;
        }
    } else {
        // Rimuovi dai preferiti
        $sql = "DELETE FROM preferiti WHERE id_utente = '$id_utente' AND id_prodotto = '$id_prodotto'";
        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Prodotto rimosso dai preferiti!";
        } else {
            $response['success'] = false;
            $response['message'] = "Errore nella rimozione dai preferiti: " . $conn->error;
        }
    }

    return $response;
}

// Verifica se l'utente è loggato
if ($userid) {
    $id_utente = $userid;

    // Ottieni l'ID del prodotto dalla richiesta GET
    $id_prodotto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id_prodotto > 0) {
        $response = aggiungiAiPreferiti($conn, $id_utente, $id_prodotto);
        echo json_encode($response);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID prodotto non fornito.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Devi essere loggato per aggiungere ai preferiti.']);
}

$conn->close();

?>
