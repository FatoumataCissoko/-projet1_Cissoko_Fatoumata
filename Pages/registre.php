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
    require_once './functions/functions.php';

    // Initialiser les variables
    $username = $password = $confirm_password = $date_of_birth = "";
    $errors = [];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire et les traiter
        $username = htmlspecialchars($_POST["username"]);
        $date_of_birth = htmlspecialchars($_POST["date_of_birth"]);
        $password = htmlspecialchars($_POST["password"]);
        $confirm_password = htmlspecialchars($_POST["confirm_password"]);

        // Validation des données en utilisant la fonction externe
        $errors = validateRegistration($username, $date_of_birth, $password, $confirm_password);

        // Traitement des données
        $conn = new mysqli('localhost', 'root', '', 'ecom1_projet');

        // Vérifier la connexion à la base de données
        if ($conn->connect_error) {

            die("Échec de la connexion à la base de données : " . $conn->connect_error);
        }

        // Hasher le mot de passe avant de l'enregistrer
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO user (username , date_of_birth, password,confirm_password) VALUES (?, ?, ?,?)");

        // Vérifier si la préparation de la requête a échoué
        if ($stmt === false) {
            die("Échec de la préparation de la requête : " . $conn->error);
        }

        // Lier les paramètres à la requête
        $stmt->bind_param("ssss", $username, $date_of_birth, $password, $confirm_password);

        // Vérifier si la liaison des paramètres a échoué
        if ($stmt === false) {
            die("Échec de la liaison des paramètres : " . $stmt->error);
        }

        // Exécuter la requête

        if ($stmt->execute()) {
            echo "Enregistrement réussi!";
        } else {


            echo "Erreur lors de l'enregistrement : " . $stmt->error;
        }

        // Fermer la connexion et la déclaration

        $stmt->close();
        $conn->close();
    }

    ?>

    <h2>Formulaire d'enregistrement</h2>
    <form action="" method="post"> <!-- Modification de l'action pour que le formulaire pointe vers lui-même -->
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <span><?php echo $errors['username'] ?? ''; ?></span>

        <br>

        <label for="date_of_birth">Date de naissance:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $date_of_birth; ?>">
        <span><?php echo $errors['date_of_birth'] ?? ''; ?></span>

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
    </form>

    <!-- Lien vers la page de connexion -->
    <p>Vous avez déjà un compte ? <a href="Pages/login.php">Connectez-vous ici</a></p>

</body>

</html>