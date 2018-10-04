<?php
echo 'in db connect<br>';
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tchat_iad;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
