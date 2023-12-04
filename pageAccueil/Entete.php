<?php
// Inclure le fichier de fonctions
include './functions/functions.php';
?>

<!-- Header et section de navigation -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="no-cache">
    <title>Vente De Chaussures</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand" href="#"><b><span class="firstWord">Chaussures</span></b><span class="secondWord"> WORKOUT IN STYLE</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['utilisateur'])) {
                    $utilisateur_prenom = $_SESSION['utilisateur_prenom'];
                    $utilisateur_nom = $_SESSION['utilisateur_nom']; ?>
                    <li class="nav-item">
                        <a class="btn btn-info" style="font-weight: bold;">Bienvenue <span class="btn btn-warning" style="color:white; font-weight: bold;"><?php echo $utilisateur_prenom . " (" . $utilisateur_nom . ")"; ?>
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
                                <li><a class="dropdown-item" href="#">Utilisateurs</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Commandes</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Se connecter</a>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </nav>
</header>

<body>