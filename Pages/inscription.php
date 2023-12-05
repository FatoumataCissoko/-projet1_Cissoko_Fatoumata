<?php
// Inclure le fichier de connexion à la base de données
include '../functions/functions.php';

// Initialiser les variables
$username = $email = $password = "";
$usernameErr = $emailErr = $passwordErr = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du nom d'utilisateur
    if (empty($_POST["username"])) {
        $usernameErr = "Le nom d'utilisateur est requis";
    } else {
        $username = test_input($_POST["username"]);
    }

    // Validation de l'e-mail
    if (empty($_POST["email"])) {
        $emailErr = "L'e-mail est requis";
    } else {
        $email = test_input($_POST["email"]);
        // Vérifier si l'e-mail est bien formaté
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format d'e-mail invalide";
        }
    }

    // Validation du mot de passe
    if (empty($_POST["password"])) {
        $passwordErr = "Le mot de passe est requis";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Si toutes les validations sont réussies, insérer les données dans la base de données
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        // Hasher le mot de passe avant de l'insérer dans la base de données
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Créer la requête SQL pour l'insertion
        $query = "INSERT INTO `user` (`user_name`, `email`, `pwd`, `role_id`) 
                  VALUES ('$username', '$email', '$hashed_password', (SELECT `id` FROM `role` WHERE `name` = 'client'))";

        // Exécuter la requête
        if (mysqli_query($databaseConnection, $query)) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur d'inscription: " . mysqli_error($conn);
        }
    }
}

// Fonction de nettoyage des données
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fermer la connexion à la base de données
mysqli_close($databaseConnection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

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
    <h2>Inscription</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username">
        <span class="error"><?php echo $usernameErr; ?></span>
        <br>

        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email">
        <span class="error"><?php echo $emailErr; ?></span>
        <br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?php echo $passwordErr; ?></span>
        <br>

        <input type="submit" value="S'inscrire">
    </form>
</body>

</html>