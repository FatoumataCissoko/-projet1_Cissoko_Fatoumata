<?php
// Inclure le fichier des fonctions
require_once '../functions/functions.php';
require_once '../functions/userCrud.php';

// Initialiser les variables
$username = $email = $password = $confirm_password = "";
$errors = [];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et les traiter
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);

    // Validation des données en utilisant la fonction externe
    $errors = validateRegistration($username, $password, $confirm_password, $email);

    // Vérifier s'il n'y a pas d'erreurs avant de traiter les données
    if (empty($errors)) {
        // Traitement des données
        $conn = connectToDatabase();

        // Hasher le mot de passe avant de l'enregistrer
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO user (user_name, email, pwd) VALUES (?, ?, ?)");

        // Vérifier si la préparation de la requête a échoué
        if ($stmt === false) {
            die("Échec de la préparation de la requête : " . $conn->error);
        }

        // Lier les paramètres à la requête
        $stmt->bind_param("sss", $username, $email, $hashed_password);

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
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
    <style>
        
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #3498db;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        span {
            color: #e74c3c;
            display: block;
            margin-top: 5px;
        }

        p {
            margin-top: 10px;
            color: #333;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
<div class="login-container">
        <h2>Formulaire d'enregistrement</h2>
    <form action="" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <span><?php echo $errors['username'] ?? ''; ?></span><br>

        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
        <span><?php echo $errors['email'] ?? ''; ?></span><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>">
        <span><?php echo $errors['password'] ?? ''; ?></span><br>

        <label for="confirm_password">Confirmer le mot de passe:</label>
        <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password; ?>">
        <span><?php echo $errors['confirm_password'] ?? ''; ?></span><br>

        <input type="submit" value="S'inscrire">

        <!-- Lien vers la page de connexion -->
    <p>Vous avez déjà un compte ? <a href="../Pages/login.php">Connectez-vous ici</a></p>
    </form>
</div>
    

</body>

</html>
