<?php
include '../functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Ajout</title>
</head>


<body style="background:green">
    <div>
        <!-- Formulaire de déconnexion -->
        <form action="../index.php" method="post">
            <button type="submit" class="btn btn-danger mt-3">Se déconnecter</button>
        </form>
    </div>
    <div class="m-5">
        <h1 class="text-center">Gestion Produit</h1>
        <div class="d-grid gap-2 col-6 mx-auto mt-5 ">
            <a class="btn btn-primary" href="./addProduit.php">Ajouter produit</a>
            <a class="btn btn-success" href="./panier.php">
                <i class="bi bi-cart"></i> Panier
            </a>
        </div>


        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php
                    $products = getProduits();

                    if (isset($products) && is_array($products)) {
                        $i = 1;
                        foreach ($products as $product) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><img src="../<?php echo $product['img_url']; ?>" height="150" width="150" alt="<?php echo $product['img_url']; ?>"></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td>
                                    <div class="row">
                                        <!-- Formulaire pour ajouter le produit au panier -->
                                        <form action="./panier.php" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                                            <button type="submit" name="add_to_cart">Ajout au Panier</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "Aucun produit disponible.";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>