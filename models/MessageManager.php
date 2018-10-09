<?php

require_once 'entities/e_message.php';
require_once 'models/DefaultManager.php';

class MessageManager extends DefaultManager
{
    public function getMessages()
    {
        $bdd = $this->dbConnect();

        try {
            $req = $bdd->prepare("SELECT m.content, m.date, u.login, u.id FROM message m LEFT JOIN user u ON m.sender = u.id ORDER BY date ASC");
            $req->execute();
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();
        }
        catch(Exception $e) {
            return array("error" => true, "messages" => array());
        }

        $messages = array();
        // create messages objects
        foreach ($results as $index => $m) {
            $sender = new User($m['id'], $m['login']);
            $messages[$index] = new Message($sender, $m['content'], new DateTime($m['date']));
        }

        return array("error" => false, "messages" => $messages);
    }

    public function sendMessage($message)
    {
        $bdd = $this->dbConnect();

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
}