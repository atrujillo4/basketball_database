<?php
    include "functions.php";
    $conn = getDatabaseConnection();
    
    $sql = "DELETE FROM Players where Player_Id=" . $_GET['Player_Id'];
    //echo "$sql";
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    header("Location: admin.php");


?>