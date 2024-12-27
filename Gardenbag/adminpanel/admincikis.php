<?php
session_start();
$_SESSION=array();
session_destroy();
header('Location: ../girisekrani/admingiriş.php');
exit();
?>