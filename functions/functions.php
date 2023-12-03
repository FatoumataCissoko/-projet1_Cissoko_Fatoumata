<?php
//Function pour s'enregistrer
function validateRegistration($username, $password, $confirm_password, $date_of_birth) {
    $errors = [];

    // Validation du nom d'utilisateur
    if (empty($username)) {
        $errors['username'] = "Veuillez saisir un nom d'utilisateur.";
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors['password'] = "Veuillez saisir un mot de passe.";
    }

    // Validation de la confirmation du mot de passe
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Veuillez confirmer le mot de passe.";
    } else {
        if ($password != $confirm_password) {
            $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
        }
    }

    // Validation de la date de naissance
    if (empty($date_of_birth)) {
        $errors['date_of_birth'] = "Veuillez saisir votre date de naissance.";
    } else {
        $date_obj = DateTime::createFromFormat('Y-m-d', $date_of_birth);

        if (!$date_obj || $date_obj->format('Y-m-d') !== $date_of_birth) {
            $errors['date_of_birth'] = "La date de naissance n'est pas valide.";
        }
    }

    return $errors;
}

//Function pour ma BD
function connectToDatabase() {
    // Paramètres de connexion à la base de données
    $DB_SERVER = 'localhost';
    $DB_USERNAME = "root";
    $DB_PASSWORD = '';
    $DB_NAME = "ecom1_projet";

    // Connexion à la base de données
    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    return $conn;
}

// Exemple d'utilisation de la fonction
$databaseConnection = connectToDatabase();

// Maintenant, $databaseConnection est l'objet de connexion à la base de données que vous pouvez utiliser dans le reste de votre script.
// Assurez-vous de fermer la connexion lorsque vous avez fini de l'utiliser.
// $databaseConnection->close();



?>



