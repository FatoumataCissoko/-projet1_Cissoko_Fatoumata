<?php
// Inclure la configuration de la base de données
include('../functions/functions.php');

// Démarrer la session
session_start();

// Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit();
}

// Récupérer la connexion à la base de données depuis la variable globale
$conn = $GLOBALS['conn'];

// Récupérer les informations de l'utilisateur
$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'adresse de livraison depuis la base de données
$sql = "SELECT u.*, a.*
        FROM `user` u
        JOIN `address` a ON u.shipping_address_id = a.id
        WHERE u.id = $user_id";
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a réussi et que les informations de l'utilisateur sont disponibles
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Récupérer les informations de l'adresse de livraison
    $street_name = $row['street_name'];
    $street_nb = $row['street_nb'];
    $city = $row['city'];
    $province = $row['province'];
    $zip_code = $row['zip_code'];
    $country = $row['country'];
}

// Récupérer les produits du panier
$cart_products = $_SESSION['cart'];

// Calculer le prix total en fonction des produits dans le panier
$total_price = 0;
foreach ($cart_products as $product) {
    $total_price += $product['quantity'] * $product['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer la Commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        p {
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Confirmez Votre Commande</h1>

    <!-- Afficher les informations sur l'utilisateur et l'adresse de livraison -->
    <p>ID Utilisateur : <?php echo $user_id; ?></p>
    <p>Adresse de Livraison :</p>
    <p>Nom de la Rue : <?php echo $street_name; ?></p>
    <p>Numéro de Rue : <?php echo $street_nb; ?></p>
    <p>Ville : <?php echo $city; ?></p>
    <p>Province : <?php echo $province; ?></p>
    <p>Code Postal : <?php echo $zip_code; ?></p>
    <p>Pays : <?php echo $country; ?></p>

    <p>Produits dans le Panier :</p>
    <ul>
        <?php foreach ($cart_products as $product) : ?>
            <li>
                <?php echo $product['name']; ?> -
                Quantité : <?php echo $product['quantity']; ?>,
                Prix : <?php echo $product['price']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Formulaire pour soumettre la commande -->
    <form action="process_commande.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        <?php foreach ($cart_products as $product) : ?>
            <input type="hidden" name="product_id[]" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="quantity[]" value="<?php echo $product['quantity']; ?>">
            <input type="hidden" name="price[]" value="<?php echo $product['price']; ?>">
        <?php endforeach; ?>
        <button type="submit">Passer la Commande</button>
    </form>
</body>

</html>
