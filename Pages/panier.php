<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // L'utilisateur n'est pas connecté, redirection vers la page de connexion
    header("Location: ../Authentification/login.php");
    exit();
}

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Gestion de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        // Récupérer les détails du produit et ajouter au panier
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];

        // Vérifier si le produit est déjà dans le panier
        $productInCart = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] === $productId) {
                $cartItem['quantity'] += 1; // Incrémenter la quantité
                $productInCart = true;
                break;
            }
        }
        unset($cartItem); // Libérer la référence explicite

        // Si le produit n'est pas dans le panier, l'ajouter
        if (!$productInCart) {
            $_SESSION['cart'][] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => 1,
            ];
        }
    } elseif (isset($_POST['empty_cart'])) {
        // Vider le panier lorsque le bouton est cliqué
        $_SESSION['cart'] = [];
    } elseif (isset($_POST['confirm_order'])) {
        // Redirection vers la page de confirmation de commande
        header("Location: ../commandes/config_commande.php");
        exit();
    }
}

// Calculer le prix total des produits dans le panier
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Voir le Panier</title>

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

    <main>
        <h1>Votre Panier</h1>

        <div class="cart-container">
            <?php
            // Afficher les articles dans le panier
            foreach ($_SESSION['cart'] as $item) {
                echo '<div class="cart-item">';
                echo '<p>' . $item['name'] . '</p>';
                echo '<p>Prix : ' . $item['price'] . ' $</p>';
                echo '<p>Quantité : ' . $item['quantity'] . '</p>';
                echo '</div>';
            }
            ?>

            <!-- Afficher le prix total des produits -->
            <p>Prix Total : <?php echo number_format($totalPrice, 2); ?> $</p>

            <!-- Formulaire pour confirmer la commande -->
            <form action="../commandes/config_commande.php" method="post">

                <?php foreach ($_SESSION['cart'] as $item) : ?>
                    <input type="hidden" name="product_id[]" value="<?php echo $item['id']; ?>">
                    <input type="hidden" name="product_name[]" value="<?php echo $item['name']; ?>">
                    <input type="hidden" name="product_price[]" value="<?php echo $item['price']; ?>">
                <?php endforeach; ?>
                <button type="submit" name="confirm_order">Confirmer la Commande</button>
            </form>
            <br>

            <!-- Formulaire pour vider le panier -->
            <form action="" method="post">
                <button type="submit" name="empty_cart">Vider le Panier</button>
            </form>
            <div>
                <!-- Formulaire de déconnexion -->
                <form action="./product.php" method="post">
                    <button type="submit" class="btn btn-danger mt-3">Retour a la gestion des produits</button>
                </form>
            </div>
        </div>
    </main>

</body>

</html>