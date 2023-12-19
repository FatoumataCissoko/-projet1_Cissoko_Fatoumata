<?php

include '../functions/functions.php';
if (isset($_GET['id'])) {
   $id = $_GET['id'];
    $produit = getProduitById($id);}


if (isset($_POST['update'])){
    $nom=$_POST['nom'];
    $prix=$_POST['prix'];
    $description=$_POST['description'];
    $quantite=$_POST['quantite'];
    if(!empty($nom) && !empty($prix)&& !empty($quantite)&& !empty($description)){
        

       if (isset($_FILES["image"]) && $_FILES["image"]["error"]=== UPLOAD_ERR_OK){
            $image_name=$_FILES["image"]["name"];
            $image_tmp=$_FILES["image"]["tmp_name"];
            $image_destination = "images/". basename($image_name);//chemin de destination de l'image
        
            //verifier que le fichier est une image
            $image_type= strtolower(pathinfo($image_destination,PATHINFO_EXTENSION));
            if (!in_array($image_type,array("jpg","jpeg","png","gif","webp"))) {
                echo "Seules les images jpg,jpeg,png et gif sont autorisees.";
                exit();
                
            }
            //deplacer l'image telecharger vers le dossier specifie
            if (move_uploaded_file($image_tmp,$image_destination)){
                modifierProduit($id,$nom,$prix,$quantite,$description,$image_destination);
            }

        } 
    }
    
else{
    modifierProduit($id,$nom,$prix,$quantite,$description);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Ajout</title>
</head>

<body style="background:grey">
    <main>
        <div class="containt mt-5">

            <form method="post" enctype="multipart/form-data">
                <h1 class="text-center">Modifier Produit</h1>
                <div class="mb-3">
                    <img src="<?php echo $produit['path'] ;?>" height="150" width="150" alt="">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" value="<?php echo $produit['nom'] ;?>" class="form-control" name="nom">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="text" value="<?php echo $product['prix'] ;?>" class="form-control" name="prix">
                </div>

                <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Leave a description here"
                        id="floatingTextarea2" style="height: 100px">
                    <?php echo $produit['description'] ;?>"
                </textarea>
                    <label for="floatingTextarea2">Description</label>
                </div><br>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantite</label>
                    <input type="number" value="<?php echo $product['quantite'] ;?>" class="form-control"
                        name="quantite">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" name='update' type="submit">Modifier Produit</button>
                </div>
            </form>
        </div>
        </section>
    </main>
</body>

</html>