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
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333; /* Couleur de fond gris foncé */
            overflow: hidden;
        }

        .nav {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .nav a {
            text-decoration: none;
            color: white;
        }

        .nav:hover {
            background-color: #ddd; /* Changement de couleur au survol */
            color: black;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="nav"><a href="./index.php">Home</a></div>
        <div class="nav"><a href="./Pages/login.php">Sign Up</a></div>
        <div class="nav"><a href="./Pages/inscription.php">Login</a></div>
    </div>

    <main>
    <!-- Section de la bannière -->
    <section class="banner">
        <h2><span class="secondWord" style="font-size: larger;">Chaussures Fashion</span></h2>
        <hr>
    </section>

    <!-- Image d'accueil -->
    <div class="welcomeImg">
        <img src="./images/site/mag3.png" alt="chaussures" class="img-fluid">
    </div>

    <!-- Paragraphes aléatoires sur les chaussures -->
    <div class="quotes">
        <span class="paragraphe">
            "Le style commence par de bonnes chaussures.Le bonheur ne s'acquiert pas, il ne réside pas dans les apparences, chacun d'entre nous le construit à chaque instant de sa vie avec son coeur." - <NAME>, <span class="text-danger">Proverbe Africain</span>
                <br />
                <br />
                "Chaque pas compte. Faites en sorte qu'ils soient élégants." – <NAME>, <span class="text-warning">Directeur de la mode</span>
        </span>
        <br />
        <br />
        <span class="paragraphe">Trouvez la paire de chaussures parfaite pour chaque occasion chez Chaussures Fashion.</span>
    </div>

    <!-- Cartes de produits -->
    <div class="cardcontainer">
        <div class="card" style="width: 18rem; background-color: lightpink;">
            <div class="card-body">
                <h5 class="card-title">Baskets</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">#Tendance</h6>
                <p class="card-text">
                    Des baskets confortables et élégantes pour vos journées décontractées. Découvrez notre collection dès maintenant.
                </p>
            </div>
        </div>
        <div class="card" style="width: 18rem; background-color: lightblue;">
            <div class="card-body">
                <h5 class="card-title">Escarpins</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">#Élégance</h6>
                <p class="card-text">
                    Les escarpins parfaits pour ajouter une touche d'élégance à votre tenue. Explorez nos styles variés.
                </p>
            </div>
        </div>
        <div class="card" style="width: 18rem; background-color: lightgreen;">
            <div class="card-body">
                <h5 class="card-title">Bottes</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">#Hiver</h6>
                <p class="card-text">
                    Restez au chaud avec nos bottes tendance. Idéales pour les journées fraîches d'hiver.
                </p>
            </div>
        </div>
    </div>
</main>
</body>
<?php 
include './Pages/footer.php'
?>
</html>

