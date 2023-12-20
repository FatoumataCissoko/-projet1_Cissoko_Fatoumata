<?php 
session_start();
include '../functions/functions.php';

if (isset($_POST['modifierPanier'])) {
    $id = $_POST['id_product'];
    $qteDemander = $_POST['qteDemander'];
    updatePanier($id, $qteDemander);
}

if (isset($_POST['supprimerPanier'])) {
    $id = $_POST['id_product'];
    deleteElementPanier($id);
}

$panier = getAllPanier();
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
</head></head>

<body style="background:grey">
    <main>
        <section>
            <div class="contain m-5">
                <h1>Panier</h1>
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
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $i = 1;
                        $totalPanier = 0;
                        foreach ($panier as $id_product => $qteDemander) {
                            $product = getProduitById($id_product);
                            $total = $qteDemander * $product['prix'];
                            $totalPanier += $total;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><img src="<?php echo $product['path']; ?>" height="150" width="150"></td>
                                <td><?php echo $product['nom']; ?></td>
                                <td><?php echo $product['prix']; ?></td>
                                <form method="post">
                                    <td><input type="number" min="1" max="50" name="qteDemander" value="<?php echo $qteDemander; ?>"></td>
                                    <td><?php echo $total; ?></td>
                                    <td>
                                        <input type="hidden" name="id_product" value="<?php echo $id_product; ?>">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" name="modifierPanier" class="btn btn-info"><i class="bi bi-pencil-square"></i></button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" name="supprimerPanier" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-success col-auto text-end">
                    Total: <?php echo $totalPanier; ?>$
                </div>
            </div>
        </section>
    </main>
</body>

</html>