<?php 
require_once 'auth.php';

if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

// Verifica se l'utente è loggato
$is_logged_in = isset($_SESSION['_agora_user_id']);

// Connessione al database
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Se il modulo è stato inviato, salva la recensione nel database
if ($is_logged_in && $_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['recensione'])) {
    $userid = $_SESSION['_agora_user_id'];
    $recensione = $conn->real_escape_string($_POST['recensione']);

    $stmt = $conn->prepare("INSERT INTO recensioni (id, recensione) VALUES (?, ?)");
    $stmt->bind_param("is", $userid, $recensione);

    // Esegui la query preparata
    if ($stmt->execute()) {
        echo "Recensione salvata con successo.";
    } else {
        echo "Errore durante il salvataggio della recensione: " . $conn->error;
    }

    // Chiudi la query preparata
    $stmt->close();
}
// Ottieni tutte le recensioni dal database
$sql = "SELECT users.username, recensioni.recensione FROM recensioni JOIN users ON recensioni.id = users.id";
$result = $conn->query($sql);

?>

<html>

<head>
    <meta charset="UTF-8">

    <link rel='stylesheet' href='mhw3recensioni.css'>
    <title>Recensioni</title>
   
</head>

<body>

    <div id="logo">
            <img src="images/SCRITTAAMABILE.png">
        </div>
    
    <h1>Recensioni</h1>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>" . $row['username'] . ":</strong> " . $row['recensione'] . "</p>";
        }
    } else {
        echo "<p>Nessuna recensione disponibile.</p>";
    }
    $result->free();
    ?>

    <?php if ($is_logged_in): ?>
        <h2>Lascia una Recensione</h2>
        <form method="post" action="recensioni.php">
            <label for="recensione">Recensione:</label><br>
         <div id='textrecensione'>
          <textarea id="recensione" name="recensione" required></textarea><br>
         </div>
            <input type="submit" value="Invia">
        </form>
    <?php else: ?>
        <p><a href="login.php">Accedi</a> per lasciare una recensione.</p>
    <?php endif; ?>

    <p><a href="home.php">Torna alla Home</a></p>
    

    
    
</body>
</html>

<?php
$conn->close();
?>