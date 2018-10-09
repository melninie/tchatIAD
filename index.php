<?php

// this file is the router

require_once ('controllers/ChatController.php');
require_once ('controllers/UserController.php');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "chat":
            chat();
            break;
        case "send_message":
            if (!empty($_POST) && isset($_POST['message'])) {
                sendMessage($_POST['message']);
            }
            else {
                // redirect home page
                authentication(null);
            }
            break;
        case "logout":
            // destruction des variables de session
            session_unset ();
            session_destroy ();
            // redirect home page
            authentication(null);
            break;
        default:
            authentication(null);
            break;
    }
}
else {
    if (!empty($_POST) && isset($_POST['login'])) {
        authentication($_POST['login']);
    }
    else {
        authentication(null);
    }
}