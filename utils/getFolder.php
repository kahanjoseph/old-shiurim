<?php 
require_once("dbFunctions.php");
echo json_encode(getItem($_GET['item']));
?>