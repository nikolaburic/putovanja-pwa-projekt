<?php
session_start();

// obriši sve session varijable
session_unset();

// uništi session
session_destroy();

// vrati korisnika na početnu
header("Location: index.php");
exit();
?>