<?php 
    require_once 'dbFunctions.php';
    addItem($_GET);
    print_r(json_encode(getList()));
?>