<?php
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
?>