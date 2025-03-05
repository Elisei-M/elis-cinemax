<?php
require "authenticator.php";

$dbname = 'Cinemax';

// Verifică dacă variabilele sunt definite
if (!isset($servername, $username, $password)) {
    die("Eroare: Variabilele pentru conexiune nu sunt definite.");
}

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
