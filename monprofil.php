<?php
include 'connexion.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h2>Profil</h2>
    <p>Nom d'utilisateur: <?php echo $user['username']; ?></p>
    <p>Nom: <?php echo $user['name']; ?></p>
    <p>Adresse: <?php echo $user['address']; ?></p>

    <a href="edit_profile.php">Modifier le profil</a>
    <br>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
