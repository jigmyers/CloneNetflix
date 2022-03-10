<?php

session_start();
session_unset();
session_destroy();

setcookie('auth', '', time() - 1, '/', null, false, true); // Suppression du cookie
header('location: ../index.php');
exit();
