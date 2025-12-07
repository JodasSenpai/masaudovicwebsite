<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/config/settings.php';
if(!isset($_SESSION['loggedin'])){
    header('Location: /');
    exit('Not logged in');
}

?>