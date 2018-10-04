<?php

session_start();

// Check that a user is 'logged'
if (empty($_SESSION) || !isset($_SESSION['login']) || empty($_SESSION['login']) || !isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:../index.php');
}

include ('../models/m_message.php');
include ('../entities/e_message.php');
include ('../entities/e_user.php');

if ($messages = getMessages()) {
    echo json_encode(array('return' => 'done', 'messages' => $messages));
}
else {
    echo json_encode(array('return' => 'error'));
}