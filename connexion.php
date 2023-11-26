<?php
include 'signup.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Vérifie si le nom d'utilisateur est unique
    $check_username = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($check_username);

    if ($result->num_rows == 0) {
        // Enregistre le nouvel utilisateur
        $insert_sql = "INSERT INTO users (username, password, name, address) VALUES ('$username', '$password', '$name', '$address')";
        $conn->query($insert_sql);
        header("Location: login.php");
        exit();
    } else {
        $error = "Le nom d'utilisateur existe déjà";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form method="post" action="">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username">
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password">
        <br>
        <label for="name">Nom:</label>
        <input type="text" name="name">
        <br>
        <label for="address">Adresse:</label>
        <input type="text" name="address">
        <br>
        <input type="submit" value="S'inscrire">
    </form>
    <?php if (isset($error)) { echo $error; } ?>
</body>
</html>
