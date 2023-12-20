<?php
// Inclure la configuration de la base de données
include('../functions/functions.php');
session_start();

// Rediriger à la page de connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger à la page de connexion ou gérer l'accès non autorisé
    header("Location: ../auth/login.php");
    exit();
}

// Récupérer la connexion à la base de données depuis la variable globale
$conn = $GLOBALS['conn'];

// Obtenir l'ID de l'utilisateur
$user_id = $_SESSION['user_id'];

// Obtenir les informations de l'adresse de livraison depuis la base de données
$sql = "SELECT u.*, a.* FROM `user` u
        JOIN `address` a ON u.shipping_address_id = a.id
        WHERE u.id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Obtenir les informations de l'adresse de livraison
    $street_name = $row['street_name'];
    $street_nb = $row['street_nb'];
    $city = $row['city'];
    $province = $row['province'];
    $zip_code = $row['zip_code'];
    $country = $row['country'];
} else {
    // Gérer le cas où l'information de l'adresse ne peut pas être obtenue
    header("Location: failure.php?error=address");
    exit();
}

// Obtenir les produits du panier
$cart_products = $_SESSION['cart'];

// Calculer le prix total en fonction des produits dans le panier
$total_price = 0;
foreach ($cart_products as $product) {
    $total_price += $product['quantity'] * $product['price'];
}

// Insérer dans la table user_order
$sql_insert_order = "INSERT INTO `user_order` (`ref`, `date`, `total`, `user_id`) VALUES ('$order_reference', NOW(), $total_price, $user_id)";
$result_insert_order = mysqli_query($conn, $sql_insert_order);

if (!$result_insert_order) {
    // Gérer l'erreur lors de l'insertion dans la table user_order
    header("Location: failure.php?error=order");
    exit();
}

// Obtenir l'ID de la commande pour une utilisation ultérieure
$order_id = mysqli_insert_id($conn);

// Nettoyer les variables de session
unset($_SESSION['cart']);

// Rediriger à la page de succès
header("Location: success.php");
exit();
?>
