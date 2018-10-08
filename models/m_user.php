<?php

require_once '../controllers/c_db_connect.php';
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
 * Get all users in DB + dat of last sended message
 */
function getUsers()
{
    global $bdd;
    try {
        $req = $bdd->prepare(
            "SELECT u1.id, u1.login, date_last_mess FROM user u1 " .
            "left join (" .
                "SELECT u2.login, max(date) as date_last_mess FROM message left join user u2 on message.sender=u2.id group by sender" .
            ") t1 on t1.login = u1.login ORDER BY date_last_mess DESC, login ASC");
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
    }
    catch(Exception $e) {
        return array("error" => true, "users" => array());
    }
    return array("error" => false, "users" => $results);
}