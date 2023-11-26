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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $update_sql = "UPDATE user SET name = '$name', address = '$address', password = '$password' WHERE username = '$username'";
    $conn->query($update_sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>
<body>
    <h2>Modifier le profil</h2>
    <form method="post" action="">
        <label for="name">Nom:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>">
        <br>
        <label for="address">Adresse:</label>
        <input type="text" name="address" value="<?php echo $user['address']; ?>">
        <br>
        <label for="password">Mot de passe:</label>
        <input type="submit" value="Save">
    </form>
</body>
</html>
