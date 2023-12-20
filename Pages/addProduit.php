<?php
include '../functions/functions.php';

if (isset($_POST['ajouter'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';

    if (!empty($name) && !empty($price) && !empty($quantity) && !empty($description)) {
        // Vérifier si le fichier image a été téléchargé avec succès
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
            $image_destination = "../images/produits/" . basename($image_name);

            // Vérifier que le fichier est une image
            $image_type = strtolower(pathinfo($image_destination, PATHINFO_EXTENSION));
            if (!in_array($image_type, array("jpg", "jpeg", "png", "gif", "webp"))) {
                echo "Seules les images jpg, jpeg, png et gif sont autorisées.";
                exit();
            }

            // Déplacer l'image téléchargée vers le dossier spécifié
            if (move_uploaded_file($image_tmp, $image_destination)) {
                // Appeler la fonction saveProduit pour enregistrer le produit dans la base de données
                saveProduit($name, $price, $quantity, $description, $image_destination);
                echo "Produit ajouté avec succès."; 
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } 
}
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
    
    <body style="background:grey">
    <div>
                <!-- Formulaire de déconnexion -->
                <form action="./product.php" method="post">
                    <button type="submit" class="btn btn-danger mt-3">Retour a la gestion des produits</button>
                </form>
            </div>
<main>
    <div class="containt mt-5 mt-5">
        
        <form method="post" enctype="multipart/form-data">
        
        
        <div class="mb-3">
        <h1 class="text-center">Ajouter Produit</h1>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="text" class="form-control" name="prix">
                </div>
                
                <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Leave a description here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div><br>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantite</label>
                    <input type="number" class="form-control" name="quantite">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" name='ajouter' type="submit">Enregistrer Produit</button>
                </div>
        </form>
</div>
    </section>
</main>
</body>
</html>