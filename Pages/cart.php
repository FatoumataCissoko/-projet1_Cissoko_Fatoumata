<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

include 'product.php';  

if (isset($_GET['action'])) {
    $productId = $_GET['id'];

    switch ($_GET['action']) {
        case 'add':
            if (!isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] = 1;
            } else {
                $_SESSION['cart'][$productId]++;
            }
            break;

        case 'remove':
            // Supprimer un article du panier
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]--;
                if ($_SESSION['cart'][$productId] <= 0) {
                    unset($_SESSION['cart'][$productId]);
                }
            }
            break;

        case 'update':
            // Mettre à jour la quantité d'un article dans le panier
            if (isset($_POST['quantity'])) {
                $newQuantity = max(0, (int)$_POST['quantity']);  
                $_SESSION['cart'][$productId] = $newQuantity;
            }
            break;
        default:
            break;
    }
}

?>

<!-- Affichage du contenu du panier -->

<h2>Panier</h2>

<?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
    <?php $product = $products[$productId]; ?>
    <div>
        <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <p><?= $product['name'] ?></p>
        <p>Prix: <?= $product['price'] ?> CA</p>
        <p>Quantité: <?= $quantity ?></p>
        <form method="post" action="cart.php?action=update&id=<?= $productId ?>">
            <label for="quantity">Nouvelle quantité:</label>
            <input type="number" name="quantity" value="<?= $quantity ?>" min="0">
            <input type="submit" value="Mettre à jour">
        </form>
        <p><a href="cart.php?action=remove&id=<?= $productId ?>">Retirer du panier</a></p>
    </div>
<?php endforeach; ?>
