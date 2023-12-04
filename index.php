<?php
// Inclusion du fichier d'en-tête
include "pageAccueil/Entete.php";
?>

<main>
    <!-- Section de la bannière -->
    <section class="banner">
        <h2><span class="secondWord" style="font-size: larger;">Chaussures Fashion</span></h2>
        <hr>
    </section>

    <!-- Image d'accueil -->
    <div class="welcomeImg">
        <img src="images/site/mag3.png" alt="chaussures" class="img-fluid">
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

<?php 
include "./footer.php"; 
?>