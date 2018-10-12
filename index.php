<?php

// this file is the router

require_once ('controllers/ChatController.php');
require_once ('controllers/UserController.php');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "chat":
            $chatController = new ChatController();
            $chatController->chat();
            break;
        case "send_message":
            if (!empty($_POST) && isset($_POST['message'])) {
                $chatController = new ChatController();
                $chatController->sendMessage($_POST['message']);
            }
            else {
                // redirect home page
                $userController = new UserController();
                $userController->authentication(null);
            }
            break;
        case "logout":
            // destruction des variables de session
            session_unset ();
            session_destroy ();
            // redirect home page
            $userController = new UserController();
            $userController->authentication(null);
            break;
        default:
            $userController = new UserController();
            $userController->authentication(null);
            break;
    }
}
else {
    if (!empty($_POST) && isset($_POST['login'])) {
        // user try to login
        $userController = new UserController();
        $userController->authentication($_POST['login']);
    }
    else {
        // first arrival home page
        $userController = new UserController();
        $userController->authentication(null);
    }
}