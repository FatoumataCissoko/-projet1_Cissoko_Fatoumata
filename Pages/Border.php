<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
    header("Location: login.php");
    exit();
}

// Obtenir le rôle de l'utilisateur depuis la session
$user_role = $_SESSION['user_role'];

// Vérifier si l'utilisateur a le rôle d'administrateur
if ($user_role != 1) {
    // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
    header("Location: ../index.php");
    exit();
}

// Si l'utilisateur est un administrateur, afficher le tableau de bord de l'administrateur
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord administrateur</title>

    <style>
        /* Style pour la page */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style pour la liste non ordonnée */
        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        /* Style pour les éléments de liste */
        li {
            margin: 10px 0;
        }

        /* Style pour les liens */
        a {
            display: block;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <h2>Bienvenue dans le tableau de bord administrateur</h2>

    <!-- Menu de navigation utilisant une liste non ordonnée -->
    <ul>
        <li><a href="../pageAccueil/Entete.php">Accueil</a></li>
        <li><a href="addProduit.php">Ajouter un produit</a></li>
        <li><a href="adduser.php">Liste des utilisateurs</a></li>
        <li><a href="view_search_orders.php">Liste des commandes</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    </ul>

</body>

</html>
