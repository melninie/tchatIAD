<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Chargement des classes
require_once('models/UserManager.php');

class UserController
{
    public function authentication($login)
    {
        if (!empty($login) && $login != null && $login != '') {
            $userManager = new UserManager(); // Création d'un objet
            $user = $userManager->authentication($login); // Appel d'une fonction de cet objet

            if ($user == null) {
                $message = "alreadyExist";
            } else {
                header('location:index.php?action=chat');
            }
        }
        require_once('views/v_authentication.php');
    }
}