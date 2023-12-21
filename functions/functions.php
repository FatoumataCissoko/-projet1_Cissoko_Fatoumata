<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Function pour s'enregistrer
function validateRegistration($username, $email, $password, $confirm_password, $city)
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

    // Validation de la ville
    if (empty($city)) {
        $errors['city'] = "Veuillez saisir votre ville.";
    }

    return $errors;
}


//Function pour ma BD
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Variable globale pour stocker la connexion
$conn = [];

// Fonction pour la connexion à la base de données
function connectToDatabase()
{
    // Paramètres de connexion à la base de données
    $DB_SERVER = 'localhost';
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "ecom1_project";

    // Connexion à la base de données
    $conn['connexion'] = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Vérifier la connexion
    if ($conn['connexion']->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn['connexion']->connect_error);
    }

    return $conn['connexion'];
}

// Exemple d'utilisation de la fonction
$databaseConnection = connectToDatabase();

//---------------------------------------Produits----------------------------------------------


// Function getallproducts
function getAllProducts($nom, $prix, $quantity, $description, $imgPath)
{
    $conn = connectToDatabase();

    // Vérifiez la connexion à la base de données

    $sql = 'INSERT INTO product (name, price, quantity, description, img_url) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    // Vérifiez la préparation de la requête
    if (!$stmt) {
        echo "Erreur de préparation de la requête: " . $conn->error;
        return;
    }

    $stmt->bind_param('sdis', $nom, $prix, $quantity, $description, $imgPath);

    $resultat = $stmt->execute();
    $resultats = $stmt->get_result();
    $stmt->close();
    $conn->close();

    if ($resultat) {
        header('Location: ./product.php');
    } else {
        echo "Erreur lors de l'ajout du produit";
    }
    foreach ($resultats as $product) {
        $products[] = $product;
    }
    return ($products);
}

function getProduits()
{
    $conn = connectToDatabase();

    if (!$conn) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "SELECT * FROM product";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    if (!$stmt->execute()) {
        die("Erreur d'exécution de la requête : " . $stmt->error);
    }

    $resultats = $stmt->get_result();
    $produits = $resultats->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $produits;
}


function getProduitById($id)
{
    $conn = connectToDatabase();

    if (!$conn) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "SELECT p.id_product, p.nom, p.price, p.quantity, p.description, i.path
            FROM product 
            JOIN image i ON i.id_product = p.id_product
            WHERE p.id_product = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        die("Erreur d'exécution de la requête : " . $stmt->error);
    }

    $resultats = $stmt->get_result();
    $produit = $resultats->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $produit;
}


function modifierProduit($id, $nom, $prix, $quantity, $description)
{
    $conn = connectToDatabase();
    $sql = 'UPDATE product set nom=?, price=?,quantity=?,description=? where id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdisi", $nom, $prix, $quantity, $description, $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        header('Location: ./product.php');
    } else {
        echo 'Une erreur lors de la modification';
    }
}

function saveProduit($name, $price, $quantity, $description, $path)
{
    $conn = connectToDatabase();
    $sql = "INSERT INTO product(name,price,quantity,description)
    values(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdis", $name, $price, $quantity, $description);
    $estSave = $stmt->execute();
    if ($estSave) {
        $id_product = $conn->insert_id;
        saveImage($path, $id_product);
    }
}

function deleteProduit($id_product)
{

    $conn = connectToDatabase();
    $sql = "DELETE from product 
    where id_product=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produit);
    $estDelete = $stmt->execute();
    header('Location: ./product.php');
}

function saveImage($path, $id_product)
{
    $conn = connectToDatabase();
    $sql = "INSERT INTO image(path,id_product)
    values(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $path, $id_product);
    $estSave = $stmt->execute();
    if ($estSave) {

        header('Location: ./product.php');
    }
}

function updateImage($id_produit, $image_destination)
{
    $conn = connectToDatabase();
    $sql = "UPDATE image set path=?
    where id_product=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $image_destination, $id_produit);
    $estUpdate = $stmt->execute();
    if ($estUpdate) {
        if (!empty($image_destination)) {
            header('Location: ./product.php');
        }
    }
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
            $data['user_id'],
            $data['username'],
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


// Fonction pour obtenir le rôle de l'utilisateur
function getUserRole($username)
{
    // Assurez-vous d'avoir une connexion à la base de données ici
    $conn = connectToDatabase();

    // Requête SQL pour récupérer le rôle de l'utilisateur en fonction du nom d'utilisateur
    $sql = "SELECT role FROM user WHERE user_name = ?";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    // Vérification de la préparation de la requête
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }

    // Liaison des paramètres
    $stmt->bind_param('s', $username);

    // Exécution de la requête
    if (!$stmt->execute()) {
        die("Erreur d'exécution de la requête : " . $stmt->error);
    }

    // Liaison des résultats
    $stmt->bind_result($role);

    // Récupération du résultat
    if ($stmt->fetch()) {
        // Retourner le rôle
        return $role;
    } else {
        // Gérer le cas où l'utilisateur n'a pas de rôle défini
        return "Role non défini";
    }

    // Fermeture de la déclaration
    $stmt->close();

    // Fermeture de la connexion
    $conn->close();
}

/*-----------------------------------CartPay---------------------------------------------*/

function addCart($id, $quantite, $ishome = true)
{
    $_SESSION['cart'][$id] = $quantite;
    if ($ishome) {
        header('Location: ./product.php');
        exit();
    } else {
        header('Location: ./cart.php');
        exit();
    }
}
function qteCart()
{
    $countElmnt = count($_SESSION['cart']);
    return $countElmnt;
}
function getAllCart()
{
    return $_SESSION['cart'];
}
/*-----------------------------------Panier--------------------------*/
function countElementPanier()
{
    return count($_SESSION['panier']);
}
function getAllPanier()
{
    return $_SESSION['panier'];
}
function deleteElementPanier($id_product, $estAccueil = true)
{
    unset($_SESSION['panier'][$id_product]);
    header("Location: ./panier.php");
}


// Fonction pour mettre à jour la quantité d'un produit dans le panier
function updatePanier($idProduct, $quantity)
{
    // Vérifier si le panier existe déjà dans la session
    if (isset($_SESSION['panier'])) {
        if (isset($_SESSION['panier'][$idProduct])) {
            $_SESSION['panier'][$idProduct] = $quantity;
        } else {
            // Si le produit n'est pas encore dans le panier, l'ajouter
            $_SESSION['panier'][$idProduct] = $quantity;
        }
    } else {
        $_SESSION['panier'] = array(
            $idProduct => $quantity
        );
    }
}

