<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Chargement des classes
require_once('models/UserManager.php');
require_once('models/MessageManager.php');


class ChatController
{
    public function chat()
    {
        // Check that a user is 'logged'
        if (empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])) {
            // if not redirect home page
            header('location:index.php');
        }
        $userManager = new UserManager();
        $res_users = $userManager->getUsers();

        $messageManager = new MessageManager();
        $res_messages = $messageManager->getMessages();

        require_once('views/v_chat.php');
    }

    public function sendMessage($message_string)
    {

        $user = unserialize($_SESSION['user']);
        $message = new Message($user, $message_string, new DateTime());

        $messageManager = new MessageManager();
        $messageManager->sendMessage($message);

        // redirect chat
        header('location:index.php?action=chat');
    }
}