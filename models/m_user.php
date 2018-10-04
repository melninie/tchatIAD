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

/*
 * Get all users in DB
 */
function getUsers()
{
    global $bdd;
    $req = $bdd->prepare(
        "SELECT u1.login, date FROM user u1 " .
        "left join (" .
            "SELECT u2.login, max(date) as date FROM message left join user u2 on message.sender=u2.id group by sender" .
        ") t1 on t1.login = u1.login ORDER BY date DESC, login ASC");
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return ($results);
}