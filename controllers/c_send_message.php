<?php

session_start();

// Check that a user is 'logged'
if (empty($_SESSION) || !isset($_SESSION['login']) || empty($_SESSION['login']) || !isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:../index.php');
}

include ('../models/m_message.php');
include ('../entities/e_message.php');
include ('../entities/e_user.php');

$user = new User($_SESSION['id'], $_SESSION['login']);
$message = new Message($user, $_POST['message'], new DateTime());

if (sendMessage($message)) {
    echo json_encode(array('return' => 'done'));
}
else {
    echo json_encode(array('return' => 'error'));
}