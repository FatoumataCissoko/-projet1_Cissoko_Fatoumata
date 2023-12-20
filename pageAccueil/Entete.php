<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        nav ul li a:hover {
            color: #ff9900;
        }

        #logo img {
            max-width: 80px;
            height: auto;
            border-radius: 50px;
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../Pages/inscription.php">Register</a></li>
                <li><a href="../Pages/login.php">Login</a></li>
                <li><a href="../Authentification/profil.php">Profile</a></li>
                <li> <a href="../Pages/cart.php">Cart</a></li>
            </ul>
        </nav>
        
    </header>
</body>

</html>