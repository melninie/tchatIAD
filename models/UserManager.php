<?php

require_once 'entities/e_user.php';

class UserManager
{
    public function authentication($login)
    {
        if (!empty($login) && $login != null && $login!= '') {
            $bdd = $this->dbConnect();

            $req = $bdd->prepare("SELECT * FROM user WHERE login = ?");
            $req->execute(array($login));
            $req->closeCursor();

            // Check that the login is unique
            if ($req->rowCount() == 0) {
                $user = $this->addUser($login);
                session_start();
                $_SESSION['user'] = $user;

                return $user;
            }
            else {
                return null;
            }
        }
    }

    private function addUser($login)
    {
        $bdd = $this->dbConnect();

        $req = $bdd->prepare("INSERT INTO user (login) VALUES (?)");
        $req->execute(array($login));
        $req->closeCursor();
        $id = $bdd->lastInsertId();
        $user = new User($id, $login);
        return serialize($user);

    }

    public function getUsers()
    {
        $bdd = $this->dbConnect();
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
            echo $e;die;
            return array("error" => true, "users" => array());
        }

        //create users objects
        $users = array();
        foreach ($results as $index => $u) {
            $last_message = $u['date_last_mess'];
            $users[$index] = array('user' => new User($u['id'], $u['login']), 'date_last_message' => $last_message);
        }

        return array("error" => false, "users" => $users);
    }

    private function dbConnect()
    {
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=tchat_iad;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }        return $bdd;
    }
}