<?php include "../pageAccueil/Entete.php";
 $produits = getAllProducts(); ?>
<main>
  <section>
    <div class="registerfrm">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <h4> Gérer les produits</h4>
            <hr>
            <div class="mb-3">
              <a href="addProduit.php" class="btn btn-success">Ajouter un nouveau produit</a>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Img</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Description de l'article</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($produits as $product) { ?>
                  <tr>
                    <th scope="row"><?php echo $product['id']; ?></th>
                    <th scope="row"><img src="<?php echo $product['chemin']; ?>" width="50" height="50" alt=""></th>
                    <td><?php echo $product['nom']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['price']; ?></td>               
                    <td><?php echo $product['description']; ?></td>
                    <td>
                      <a href="./modifyProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <a href="./deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash3-fill"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
</body>
</html>
