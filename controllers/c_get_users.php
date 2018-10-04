<?php

session_start();

// Check that a user is 'logged'
if (empty($_SESSION) || !isset($_SESSION['login']) || empty($_SESSION['login']) || !isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:../index.php');
}

include ('../models/m_user.php');

if ($users = getUsers()) {
    echo json_encode(array('return' => 'done', 'users' => $users));
}
else {
    echo json_encode(array('return' => 'error'));
}