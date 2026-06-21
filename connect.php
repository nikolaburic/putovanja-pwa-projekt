<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "putovanja";        // ← tvoja baza se zove "putovanja"

// Kreiranje konekcije (objektni način - preporučeno)
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Greška pri spajanju na bazu: " . $conn->connect_error);
}

// Postavljanje kodne stranice (za hrvatska slova)
$conn->set_charset("utf8mb4");
?>