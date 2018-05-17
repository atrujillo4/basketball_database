<?php

    
    session_start();
    include "functions.php";
    
    $db = getDatabaseConnection();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users_b WHERE username = '$username' AND password = '$password'";
    
    $sql = "SELECT * FROM users_b WHERE username = :username AND password = :password";
    
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
    $statement = $db->prepare($sql);
    $statement->execute($np);
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    echo $username;
    echo $password;
    print_r ($record);
    if(empty($record)){
         header("Location: error.php");
    }
    if(!empty($record)){
        $_SESSION['username'] = $record['username'];
        header("Location: admin.php");
    }
    
    
?>