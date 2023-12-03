<?php

/**
 * Create user 
 * 
 */
function createUser(array $data)
{
    global $conn;

    $query = "INSERT INTO user(id, user_name, email, pwd, fname, lname, billing_address_id, shipping_address_id, token, role_id)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $data['user_name'],
            $data['email'],
            $data['pwd']
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($conn));
        }
    }
}

/**
 * Delete user
 */

function deleteUser(int $id)
{
    global $conn;

    $query = "DELETE FROM user WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn));
        }
    }
}

/**
 * Get all users
 */
function getAllUsers()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    return $data;
}

/**
 * Get user by id
 */

//Todo: edit to prepare
function getUserById(int $id)
{
    global $conn;

    $query = "SELECT * FROM user WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        /* Exécution de la requête */
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

        return $data;
    }
}

function getUserByName(string $user_name)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_name = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "s", $user_name);

        /* Exécution de la requête */
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // avec fetch row : tableau indexé
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
}

/**
 * Update user
 */
function updateUser(array $data)
{
    global $conn;

    $query = "UPDATE user SET user_name = ?, email = ?, pwd , addresse=? date_naissance=?, roleU=? WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        $stmt->bind_param("sssssssi", $nom, $prenom, $email, $addresse, $date_naissance, $roleU, $id);

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Erreur lors de la mise à jour de l'utilisateur : " . mysqli_error($conn));
        }
    }
}



/**
 * Validate user_name (minimum 2 caractères, maximum 50 caractères)
 */
function validateUserName(string $user_name)
{
    $user_name = trim($user_name);

    if (strlen($user_name) < 2 || strlen($user_name) > 50) {
        return false;
    }

    return true;
}
