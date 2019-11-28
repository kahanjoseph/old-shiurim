<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['loggedin'])){
    $_GET['page'] = 'login';

    if(!empty($_POST['user']) && !empty($_POST['password'])){
        $user = $_POST['user'];
    
        $query = 'SELECT id, password FROM administrators WHERE name = :user';
        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $row = $statement->fetch();
        $id = $row['id'];
        $password = $row['password'];
    
        if (is_array($row)) {
            if (password_verify($_POST['password'], $password)) {
                // Verification success! User has loggedin!
                // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['user'];
                $_SESSION['id'] = $id;
                $_GET['page'] = 'MAIN';
                header("location: index.php");
            } else {
                echo 'Incorrect password! <a href="index.php">HOME</a>';
            }
        } else {
            echo 'Incorrect username! <a href="index.php">HOME</a>';
        }
        $statement->close();
    }
}
?>