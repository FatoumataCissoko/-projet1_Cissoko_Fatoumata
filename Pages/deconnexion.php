<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Détruisez la session
    session_unset();
    session_destroy();

    // Redirigez vers la page d'accueil
    header('Location: ./index.php');
} else {
    // Si l'utilisateur n'est pas connecté, redirigez également vers la page d'accueil
    header('Location: ./index.php');
}
?>
