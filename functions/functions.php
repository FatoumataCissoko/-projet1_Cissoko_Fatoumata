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
    $DB_NAME = "ecom1_project";

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
/*--------------------------------------------

/**
 * Create user 
 * 
 */
function createUser(array $data)
{
    global $conn;

    $query = "INSERT INTO user(id, user_name, email, pwd, fname, lname, billing_address_id, shipping_address_id, token, role_id)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['fname'],
            $data['lname'],
            $data['billing_address_id'],
            $data['shipping_address_id'],
            $data['token'],
            $data['role_id']
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($conn));
        }
    }
}

/**
 * Delete user
 */

function deleteUser(int $id)
{
    global $conn;

    $query = "DELETE FROM user WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn));
        }
    }
}

/**
 * Get all users
 */
function getAllUsers()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    return $data;
}

/**
 * Get user by id
 */

//Todo: edit to prepare
function getUserById(int $id)
{
    global $conn;

    $query = "SELECT * FROM user WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        /* Exécution de la requête */
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

        return $data;
    }
}

function getUserByName(string $user_name)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_name = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "s", $user_name);

        /* Exécution de la requête */
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // avec fetch row : tableau indexé
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
}

/**
 * Update user
 */
function updateUser(array $data)
{
    global $conn;

    $query = "UPDATE user SET user_name = ?, email = ?, pwd , addresse=? date_naissance=?, roleU=? WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        $stmt->bind_param("sssssssi", $nom, $prenom, $email, $addresse, $date_naissance, $roleU, $id);

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de la mise à jour de l'utilisateur : " . mysqli_error($conn));
        }
    }
}



/**
 * Validate user_name (minimum 2 caractères, maximum 50 caractères)
 */
function validateUserName(string $user_name)
{
    $user_name = trim($user_name);

    if (strlen($user_name) < 2 || strlen($user_name) > 50) {
        return false;
    }

    return true;
}

?>


