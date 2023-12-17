<?php
// Inclure le fichier de connexion à la base de données
include '../functions/functions.php';

// Initialiser les variables
$user_name = $email = $pwd = $street_name = $street_nb = $city = $country = "";
$user_name_err = $email_err = $pwd_err = $street_name_err = $street_nb_err = $city_err = $country_err = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du nom d'utilisateur
    if (empty($_POST["user_name"])) {
        $user_name_err = "Le nom d'utilisateur est requis";
    } else {
        $user_name = test_input($_POST["user_name"]);
    }

    // Validation de l'e-mail
    if (empty($_POST["email"])) {
        $email_err = "L'e-mail est requis";
    } else {
        $email = test_input($_POST["email"]);
        // Vérifier si l'e-mail est bien formaté
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Format d'e-mail invalide";
            echo "Invalid email format: " . $email;
        }
    }

    // Validation du mot de passe
    if (empty($_POST["pwd"])) {
        $pwd_err = "Le mot de passe est requis";
    } else {
        $pwd = test_input($_POST["pwd"]);
    }

    // Validation des champs d'adresse (ajoutés)
    $street_name = test_input($_POST["street_name"]);
    $street_nb = test_input($_POST["street_nb"]);
    $city = test_input($_POST["city"]);
    // $country = test_input($_POST["country"]);


    // Si toutes les validations sont réussies, insérer les données dans la base de données
    if (empty($user_name_err) && empty($email_err) && empty($pwd_err) && empty($country_err)) {
        // Hasher le mot de passe avant de l'insérer dans la base de données
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

        // Créer la requête SQL pour l'insertion
        $query = "INSERT INTO `user` (`user_name`, `email`, `pwd`, `role_id`, `fname`, `lname`, `billing_address_id`, `shipping_address_id`, `token`) 
          VALUES ('$user_name', '$email', '$hashed_pwd', (SELECT `id` FROM `role` WHERE `name` = 'client'), '', '', 0, 0, '')";

        // Exécuter la requête
        if (mysqli_query($databaseConnection, $query)) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur d'inscription: " . mysqli_error($databaseConnection);
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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>
        body {
            background-color: #333;
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
        <h2>Inscription</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <!-- Champs du formulaire avec des étiquettes explicites -->
            <label for="user_name">Nom d'utilisateur :</label>
            <input type="text" name="user_name">
            <span><?php echo $user_name_err; ?></span>

            <label for="email">E-mail :</label>
            <input type="email" name="email">
            <span><?php echo $email_err; ?></span>

            <label for="pwd">Mot de passe :</label>
            <input type="password" name="pwd">
            <span><?php echo $pwd_err; ?></span>

            <!-- Champs d'adresse (ajoutés) -->
            <label for="street_name">Street_name :</label>
            <input type="text" name="street_name">
            <span><?php echo $street_name_err; ?></span>

            <label for="street_nb">Street_nb :</label>
            <input type="text" name="street_nb">
            <span><?php echo $street_nb_err; ?></span>

            <label for="city">City :</label>
            <input type="text" name="city">
            <span><?php echo $city_err; ?></span>

            <input type="submit" value="S'inscrire" href="login.php">

            <p>Vous êtes déjà membre ? <a href="login.php">Connectez-vous ici</a></p>
        </form>
    </div>
</body>

</html>