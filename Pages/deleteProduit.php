<?php
include '../functions/functions.php';
if(isset($_GET['id'])){
    $id_produit=$_GET['id'];
    deleteProduit($id_produit);
}
?>