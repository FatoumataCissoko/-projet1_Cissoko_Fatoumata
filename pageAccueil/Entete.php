<?php
// Inclure le fichier de fonctions
//include './functions/functions.php';

?>

<!-- Header et section de navigation -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="no-cache">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Vente De Chaussures</title>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand" href=""><b><span class="firstWord">Chaussures</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])) {
                    $user_prenom = $_SESSION['user_prenom'];
                    $user_nom = $_SESSION['user_nom']; ?>
                    <li class="nav-item">
                        <a class="btn btn-info" style="font-weight: bold;">Bienvenue <span class="btn btn-warning" style="color:white; font-weight: bold;"><?php echo $user_prenom . " (" . $utilisateur_nom . ")"; ?>
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Boutique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="monprofil.php">Mon Profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="myCart.php" class="btn btn-primary">
                            Panier <span class="badge text-bg-danger">
                                <?php echo $quantity; ?>
                            </span>
                        </a>
                    </li>
                    <?php if ($_SESSION['roleU'] == "admin") { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administration</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../Pages/addProduit.php">Gérer les Produits</a></li>
                                <li><a class="dropdown-item" href="../Pages/product.php">Utilisateurs</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../Pages/product.php">Commandes</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="./Pages/login.php">Se connecter</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>

</body>

</html>
