<?php
// Informations de connexion à la base de données
$server = 'localhost';
$userName = "root";
$pwd = "";
$db = "ecom1_projet";

// Tentative de connexion à la base de données
$conn = mysqli_connect($server, $userName, $pwd, $db);
// Vérifie si la connexion a réussi
if ($conn) {
    // la variable $conn est définie en tant que connexion globale pour être utilisée dans d'autres parties du code
    global $conn;
} else {
    // Si la connexion a échoue, affiche un message d'erreur
    echo "Error : Not connected to the $db database";
}
