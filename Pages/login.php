<?php
// Inclure le fichier de connexion à la base de données
include('../functions/functions.php');

// Initialiser les variables
$username = $password = '';
$username_err = $password_err = $login_err = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valider le nom d'utilisateur
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    if (empty($username)) {
        $username_err = 'Veuillez entrer votre nom d\'utilisateur.';
    }

    // Valider le mot de passe
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    if (empty($password)) {
        $password_err = 'Veuillez entrer votre mot de passe.';
    }

    // Vérifier s'il n'y a pas d'erreurs avant de tenter la connexion
    if (empty($username_err) && empty($password_err)) {
        // Préparer la requête de sélection
        $sql = "SELECT `id`, `user_name`, `pwd` FROM user WHERE `user_name` = ?";
        $stmt = mysqli_prepare($databaseConnection, $sql);

        // Vérifier la préparation de la requête
        if (!$stmt) {
            die("Erreur de préparation de la requête: " . mysqli_error($databaseConnection));
        }

        mysqli_stmt_bind_param($stmt, 's', $username);

        // Exécuter la requête préparée
        if (mysqli_stmt_execute($stmt)) {
            // Stocker le résultat
            mysqli_stmt_store_result($stmt);

            // Vérifier si le nom d'utilisateur existe, puis vérifier le mot de passe
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $user_id, $db_username, $db_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $db_password)) {
                        // Authentification réussie, démarrer une nouvelle session
                        session_start();

                        // Stocker les données dans les variables de session
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $db_username;

                        // Rediriger vers la page appropriée
                        header("Location: ../Pages/product.php");
                        exit();
                    } else {
                        $login_err = 'Nom d\'utilisateur ou mot de passe incorrect.';
                    }
                }
            } else {
                $login_err = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        } else {
            echo 'Erreur! Veuillez réessayer plus tard.';
        }

        // Fermer la déclaration
        mysqli_stmt_close($stmt);
    } else {
        // Gérer les erreurs
        $login_err = 'Identifiants invalides. Veuillez réessayer.';
    }
}

// Fermer la connexion
mysqli_close($databaseConnection);
?>

<!-- Le reste du code HTML de votre page de connexion -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
            background-color: blue;
        }
    </style>
</head>

<body>
    <div class="login-container">

        <a class="d-grid gap-2 col-6 mx-auto  mt-5 " href="../index.php">Accueil</a>

        <h2>Connexion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>

            <label>Mot de passe:</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>

            <div class="d-grid gap-2">
                <button type="submit" name="connexion" class="btn btn-primary">Connectez-Vous <a href="product.php"></a></button>
            </div>

            <p><?php echo $login_err; ?></p>
            <p>Vous n'avez pas de compte? <a href="inscription.php">Inscription</a></p>
        </form>
    </div>

</body>

</html>