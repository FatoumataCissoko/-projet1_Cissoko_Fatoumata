<?php
include 'connexion.php';

session_start();
if (isset($_SESSION['username'])) {
    header("Location: monprofile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifie les informations de connexion
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: monprofile.php");
        exit();
    } else {
        $error = "Identifiants invalides";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="post" action="">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username">
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password">
        <br>
        <input type="submit" value="Se connecter">
    </form>
    <?php if (isset($error)) { echo $error; } ?>
</body>
</html>
