<?php

session_start();

require_once ('../models/m_message.php');
require_once ('../entities/e_message.php');
require_once ('../entities/e_user.php');

// Check that a user is 'logged'
if (empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('location:../index.php');
}

$user = unserialize($_SESSION['user']);
$message = new Message($user, $_POST['message'], new DateTime());

if (sendMessage($message)) {
    echo json_encode(array('return' => 'done'));
}
else {
    echo json_encode(array('return' => 'error'));
}