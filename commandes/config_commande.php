<?php
// Inclure la configuration de la base de données
include('../functions/functions.php');
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifiez si la clé "connexion" est définie dans le tableau global
if (!isset($GLOBALS['connexion'])) {
    // Assurez-vous d'avoir une connexion à la base de données valide ici
    // Remplacez les valeurs de connexion par celles de votre configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecom1_project";

    // Créez une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifiez si la connexion a réussi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Affectez la connexion à la variable globale
    $GLOBALS['connexion'] = $conn;
}

// Rediriger à la page de connexion si l'utilisateur n'est pas authentifié
if (!isset($_SESSION['user_id'])) {
    // Rediriger à la page de connexion ou gérer l'accès non autorisé
    header("Location: ../Pages/login.php");
    exit();
}

// Récupérer la connexion à la base de données depuis la variable globale
$conn = $GLOBALS['connexion'];

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
    // Gérer le cas où l'information de l'adresse est correcte
    header("Location: succes.php?error=address");
    exit();
}

// Obtenir les produits du panier
$cart_products = $_SESSION['cart'];

// Calculer le prix total en fonction des produits dans le panier
$total_price = 0;
foreach ($cart_products as $product) {
    $total_price += $product['quantity'] * $product['price'];
}

// Générer une référence de commande unique (vous devez mettre en place votre propre logique ici)
$order_reference = generateOrderReference();

// Insérer dans la table user_order
$sql_insert_order = "INSERT INTO `user_order` (`ref`, `date`, `total`, `user_id`) VALUES ('$order_reference', NOW(), $total_price, $user_id)";
$result_insert_order = mysqli_query($conn, $sql_insert_order);

if (!$result_insert_order) {
    // Gérer l'erreur lors de l'insertion dans la table user_order
    header("Location: erreurCommand.php?error=order");
    exit();
}

// Obtenir l'ID de la commande pour une utilisation ultérieure
$order_id = mysqli_insert_id($conn);

// Insérer les produits dans la table order_product
foreach ($cart_products as $product) {
    $product_id = $product['id'];
    $quantity = $product['quantity'];
    $price = $product['price'];

    $sql_insert_order_product = "INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`, `price`) VALUES ($order_id, $product_id, $quantity, $price)";
    $result_insert_order_product = mysqli_query($conn, $sql_insert_order_product);

    if (!$result_insert_order_product) {
        // Gérer l'erreur lors de l'insertion dans la table order_product
        header("Location: erreurCommand.php?error=order_product");
        exit();
    }
}

// Nettoyer les variables de session
unset($_SESSION['cart']);

// Rediriger à la page de succès
header("Location: success.php");
exit();

// Fonction pour générer une référence de commande unique
function generateOrderReference() {
    // Générer une partie aléatoire (6 caractères)
    $randomPart = bin2hex(random_bytes(3)); 
    // Concaténer la partie aléatoire avec le timestamp actuel
    $orderReference = 'REF' . time() . strtoupper($randomPart);

    return $orderReference;
}
$GLOBALS['connexion']->close();
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
