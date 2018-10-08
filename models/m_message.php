<?php

require_once '../controllers/c_db_connect.php';

$bdd = connect();

/*
 * Add message in bdd
 * Return nb rows inserted
 */
function sendMessage($message)
{
    global $bdd;
    $req = $bdd->prepare("INSERT INTO message (sender, content, date) VALUES (?,?,?)");
    $params = array(
        $message->getSender()->getId(),
        $message->getContent(),
        $message->getDate()->format('Y-m-d H:i:s'),
    );
    $req->execute($params);
    $req->closeCursor();
    return ($req->rowCount());
}

/*
 * Get all messages in bdd
 */
function getMessages()
{
    global $bdd;
    try {
        $req = $bdd->prepare("SELECT m.content, m.date, u.login, u.id FROM message m LEFT JOIN user u ON m.sender = u.id ORDER BY date ASC");
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
    }
    catch(Exception $e) {
        return array("error" => true, "messages" => array());
    }

    return array("error" => false, "messages" => $results);
}
