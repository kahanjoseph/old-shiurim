<?php

require_once('view/header.php');
$file_padder = "/shiurim";
require_once('../utils/authenticatedOnly.php');

switch ( $_GET['page']) {
    case 'login':
        //header("Location: view/login.php");
        require_once('view/login.php');
        break;
    default:
        require_once('../vendor/autoload.php');
        require_once('../included.php');
        require_once('view/addFolder.php');
}

?>