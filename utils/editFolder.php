<?php 
require_once("dbFunctions.php");
editItem($_GET);
echo json_encode(getList());
?>