<?php

include '../models/m_user.php';

// If the authentication form is sent
if (!empty($_POST) && isset($_POST['login']) && !empty($_POST['login'])) {
    // Check that the login is unique
    if (loginIsUnique($_POST['login'])) {
        $id = addUser($_POST['login']);
        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['id'] = $id;
        header('location:../views/v_chat.php');
    }
    else {
        header('location:../index.php?message=alreadyExist');
    }
}
else {
    header('location:../index.php');
}