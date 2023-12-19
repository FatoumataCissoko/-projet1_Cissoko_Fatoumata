<?php
include '../functions/functions.php';
if(isset($_GET['id'])){
    $id_product=$_GET['id'];
    deleteProduit($id_product);
}
?>