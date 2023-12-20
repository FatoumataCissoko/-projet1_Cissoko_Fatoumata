<?php

include '../functions/functions.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $quantiteDemande = $_POST['quantity'];
        getAllPanier($id,$quantiteDemande);

    }

?>