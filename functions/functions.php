<?php

//Function pour s'enregistrer
function validateRegistration($username, $email, $password, $confirm_password,)
{
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

    // Validation de l'e-mail
    if (empty($email)) {
        $errors['email'] = "Veuillez saisir votre adresse e-mail.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse e-mail n'est pas valide.";
    }


    return $errors;
}

//Function pour ma BD
function connectToDatabase()
{
    // Paramètres de connexion à la base de données
    $DB_SERVER = 'localhost';
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
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

//---------------------------------------Produits----------------------------------------------


// Function getallproducts
function getAllProducts()
{
    $conn = connectToDatabase(); 
    $sql = "SELECT p.id, p.nom, p.description, p.prix, p.taille, p.quantite, i.chemin 
            FROM product p 
            JOIN Images i ON p.id = i.id_product; ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $products = array();
    foreach ($resultats as $product) {
        $products[] = $product;
    }
    return $products;
}
?>