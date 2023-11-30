<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
</head>
<body>

<?php
    // Inclure le fichier des fonctions
    require_once 'functions.php';

    // Initialiser les variables
    $username = $password = $confirm_password = "";
    $errors = [];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire et les traiter
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $confirm_password = htmlspecialchars($_POST["confirm_password"]);

        // Validation des données en utilisant la fonction externe
        $errors = validateRegistration($username, $password, $confirm_password,$date_of_birth);

        // Si aucune erreur n'est détectée, traiter les données (par exemple, enregistrement dans une base de données)
        if (empty($errors)) {
            // Traitement des données ici...
            // Enregistrement dans une base de données, envoi d'un email de confirmation, etc.
            echo "Enregistrement réussi!";
        }
    }
?>

<h2>Formulaire d'enregistrement</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" name="username" id="username" value="<?php echo $username; ?>">
    <span><?php echo $errors['username'] ?? ''; ?></span>

    <br>

    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password" value="<?php echo $password; ?>">
    <span><?php echo $errors['password'] ?? ''; ?></span>

    <br>

    <label for="confirm_password">Confirmer le mot de passe:</label>
    <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password; ?>">
    <span><?php echo $errors['confirm_password'] ?? ''; ?></span>

    <br>

    <input type="submit" value="S'inscrire">

    <!-- Lien vers la page de connexion -->
    <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
</form>

</body>
</html>
