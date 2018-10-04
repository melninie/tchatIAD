<?php

include '../controllers/c_db_connect.php';
$bdd = connect();

/*
 * Check that login is unique in DB
 * Return boolean
 */
function loginIsUnique($login)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM user WHERE login = ?");
    $req->execute(array($login));
    $req->closeCursor();
    return ($req->rowCount() == 0);
}

/*
 * Add a new user in DB
 * Return id of added user
 */
function addUser($login)
{
    global $bdd;
    $req = $bdd->prepare("INSERT INTO user (login) VALUES (?)");
    $req->execute(array($login));
    $req->closeCursor();
    return $bdd->lastInsertId();
}