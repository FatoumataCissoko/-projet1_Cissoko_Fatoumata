<?php
session_start();

include '../functions/functions.php';

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    addToCart($productId);
    echo "Produit ajouté au panier!";
}

function addToCart($productId) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    array_push($_SESSION['cart'], $productId);
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
    
    <body style="background:green">

   
<div class=" m-5 ">
    <h1 class="text-center  ">Gestion Produit</h1>
<div class="d-grid gap-2 col-6 mx-auto  mt-5 ">



  <a class="btn btn-primary" href="addProduit.php" >Ajouter produit</a>

  
</div>
<div>
<table class="table table-striped">

  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Nom</th>
      <th scope="col">Prix</th>
      <th scope="col">Quantity</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody class="table-group-divider">
    

    <?php
    $i=1;
    $produits = glob('images/produits/*.jpg');
     foreach($produits as $produit){?>

          <tr>
          <th scope="row"><?php  echo $i++;?></th>
          <td><img src="../images/produits/ echo $product['id_produits']; ?>.jpg" height="150" width="150"></td>
          <td><?php echo $produit['nom'];?></td>
          <td><?php echo $produit['prix']; ?></td>
          <td><?php echo $produit['quantity']; ?></td> 
          <td><?php echo $produit['description'];?></td>
          <td>
          <div class="row">
            <div class="col-6">
                <a href="modifierProduit.php?id=<?php echo $produit['id_produits'];?>" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
            </div>
            <div class="col-6">
                <a href="supprimerProduit.php?id=<?php echo $produit['id_produits'];?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
            </div>
                
            </div>
        </td>
        </tr>
   <?php } ?>
  </tbody>
</table>
</div>
</div>


