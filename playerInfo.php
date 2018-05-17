<?php
    include 'functions.php';
    $conn = getDatabaseConnection();
    function displayInfo(){
        global $conn;
        $playerId =  $_GET['Player_Id'];
        
        $sql = "SELECT * FROM Players NATURAL JOIN Teams WHERE Player_Id = :pId";
        
        $np = array();
        $np[":pId"] = $playerId;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<img src='" . $records[0]['picture'] . "'>" . "<br>";
        echo $records[0]['first_name'] . " " . $records[0]['last_name'] . "<br>";
        
        if($records[0]['Team_Id'] == 6){
            echo "Retired" . "<br>";
        }
        else{
            echo "Current team: " . $records[0]['current_team'] . "<br>";
            echo "<img src='" . $records[0]['Team_Logo'] ."' style='width=100px;height:100px;'>" . "<br>";
        }
        echo "Number of Championships: ". $records[0]['championships'] . "<br>";
        echo "Carrer points: " . $records[0]['carrer_points'] . "<br>";
        echo "Number of years in the NBA: " . $records[0]["nba_years"] . "<br>";
        
    }
    displayInfo();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        
        <style> @import url("css/style.css");</style>
    </head>
    <hr>
        <footer>
        <p>Created by: Adrian Trujillo</p>
        <p>CST336: Internet Programming</p>
        
        </footer>
    </hr>
    
</html>