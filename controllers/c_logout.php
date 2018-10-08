<?php
session_start ();

// destruction des variables de session
session_unset ();
session_destroy ();

header ('location:../index.php');
?>