<?php

    session_start();

    require_once ('../models/m_message.php');
    require_once ('../models/m_user.php');
    require_once ('../entities/e_message.php');
    require_once ('../entities/e_user.php');

    // Check that a user is 'logged'
    if (empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])) {
        header('location:../index.php');
    }

    // Get all the messages of db
    $res_messages = getMessages();
    $res_users = getUsers();

    if ($res_messages && $res_users) {
        if (!$res_messages['error']) {
            $messages = array();
            // create messages objects
            foreach ($res_messages['messages'] as $index => $m) {
                $sender = new User($m['id'], $m['login']);
                $messages[$index] = new Message($sender, $m['content'], new DateTime($m['date']));
            }
            // replace request result by objects
            $res_messages['messages'] = $messages;
        }
        //create users objects
        if (!$res_users['error']) {
            $users = array();
            // create messages objects
            foreach ($res_users['users'] as $index => $u) {
                $last_message = $u['date_last_mess'];
                $users[$index] = array('user' => new User($u['id'], $u['login']), 'date_last_message' => $last_message);
            }
            // replace request result by objects
            $res_users['users'] = $users;
        }

        require_once '../views/v_chat.php';
    }
    else {
        echo 'Erreur : une erreur est survenue. Merci de réessayer';
    }
