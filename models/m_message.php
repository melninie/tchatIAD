<?php

include '../controllers/c_db_connect.php';
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
