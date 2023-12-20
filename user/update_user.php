<?php
require_once('../functions/functions.php');

session_start();

// Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Traite la requête seulement si c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Récupère les données du formulaire
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Vérifie que tous les champs sont remplis
    if (empty($user_name) || empty($email) || empty($fname) || empty($lname)) {
        $error_message = "Tous les champs doivent être remplis.";
        header("Location: monprofil.php?error=$error_message");
        exit();
    }

    // Prépare et exécute la requête préparée
    $sql = "UPDATE `user` 
            SET `user_name` = ?, `email` = ?, `fname` = ?, `lname` = ? 
            WHERE `id` = ?";

    $stmt = $databaseConnection->prepare($sql);
    $stmt->bind_param("ssssi", $user_name, $email, $fname, $lname, $user_id);

    if ($stmt->execute()) {
        header("Location: monprofil.php");
    } else {
        $error_message = "Erreur lors de la mise à jour du profil : " . $stmt->error;
        header("Location: monprofil.php?error=$error_message");
        exit();
    }

    // Ferme la déclaration
    $stmt->close();
} else {
    echo "Accès non autorisé";
}

// Ferme la connexion
mysqli_close($databaseConnection);
?>
