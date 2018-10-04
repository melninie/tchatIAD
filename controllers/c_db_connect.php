<?php

function connect()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=tchat_iad;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    return $bdd;
}

