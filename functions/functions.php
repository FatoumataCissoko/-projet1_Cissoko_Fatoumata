<?php
//Function pour s'enregistrer
function validateRegistration($username, $password, $confirm_password, $date_of_birth) {
    $errors = [];

    // Validation du nom d'utilisateur
    if (empty($username)) {
        $errors['username'] = "Veuillez saisir un nom d'utilisateur.";
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors['password'] = "Veuillez saisir un mot de passe.";
    }

    // Validation de la confirmation du mot de passe
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Veuillez confirmer le mot de passe.";
    } else {
        if ($password != $confirm_password) {
            $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
        }
    }

    // Validation de la date de naissance
    if (empty($date_of_birth)) {
        $errors['date_of_birth'] = "Veuillez saisir votre date de naissance.";
    } else {
        $date_obj = DateTime::createFromFormat('Y-m-d', $date_of_birth);

        if (!$date_obj || $date_obj->format('Y-m-d') !== $date_of_birth) {
            $errors['date_of_birth'] = "La date de naissance n'est pas valide.";
        }
    }

    return $errors;
}

?>
