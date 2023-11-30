<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet</title>
</head>
<body>
<h1>Mon Projet</h1>

<a href="./pages/signup.php">S'enregistrer</a><br>
<a href="./pages/login.php">Se connecter</a>


<?php
session_start();
var_dump($_SESSION);
?>
</body>
</html>