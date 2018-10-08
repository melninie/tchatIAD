<?php

require_once '../models/m_user.php';
require_once '../entities/e_user.php';

// If the authentication form is sent
if (!empty($_POST) && isset($_POST['login']) && !empty($_POST['login'])) {
    // Check that the login is unique
    if (loginIsUnique($_POST['login'])) {
        $id = addUser($_POST['login']);
        $user = serialize(new User($id, $_POST['login']));
        session_start();
        $_SESSION['user'] = $user;
        header('location:../controllers/c_chat.php');
    }
    else {
        header('location:../index.php?message=alreadyExist');
    }
}
else {
    header('location:../index.php');
}