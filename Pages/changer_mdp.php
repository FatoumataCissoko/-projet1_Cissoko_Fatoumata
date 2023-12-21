<?php
// Inclure le fichier de configuration de la base de données
require_once('../functions/functions.php');

// Démarrer la session
session_start();

// Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtenir l'ID de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
            color: #2a78ad;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Changer le mot de passe</h2>
    <form action="changer_mdp.php" method="post">
        <label for="current_password">Mot de passe actuel :</label>
        <input type="password" name="current_password" required>
        <br>
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" name="new_password" required>
        <br>
        <label for="confirm_new_password">Confirmer le nouveau mot de passe :</label>
        <input type="password" name="confirm_new_password" required>
        <br>
        <input type="submit" value="Changer le mot de passe">
        <a href="../index.php">Accueil</a>
        <?php
        // Afficher les messages d'erreur s'ils existent
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<p class='error'>$error</p>";
        }
        ?>
    </form>
</body>

</html>
