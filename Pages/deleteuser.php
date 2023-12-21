<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
    header("Location: ./login.php");
    exit();
}

// Obtenir le rôle de l'utilisateur depuis la session
$user_role = $_SESSION['user_role'];

// Vérifier si l'utilisateur a le rôle d'administrateur
if ($user_role != 1) {
    // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
    header("Location: ./index.php");
    exit();
}

// Vérifier si l'ID de l'utilisateur à supprimer est fourni
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Se connecter à la base de données 
    require_once('../functions/functions.php');

    // Requête pour supprimer l'utilisateur
    $delete_query = "DELETE FROM `user` WHERE `id` = $user_id";
    
    // Exécuter la requête de suppression
    $result = mysqli_query($databaseConnection, $delete_query);

    // Vérifier si la suppression a réussi
    if ($result) {
        header("Location: Border.php");
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($databaseConnection);
    }

    // Fermer la connexion à la base de données
    mysqli_close($databaseConnection);
} else {
    echo "ID utilisateur non fourni.";
}
?>
