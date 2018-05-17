<?php
    include "functions.php";
    $db = getDatabaseConnection();
    
    if(isset($_GET["updatePlayer"])){
        $sql = "UPDATE Players SET 
                        Player_Id = :Player_Id,
                        first_name = :first_name,
                        last_name = :last_name,
                        nba_years = :nba_years,
                        current_team = :current_team,
                        carrer_points = :carrer_points,
                        championships = :championships,
                        picture = :picture
                WHERE Player_Id = :Player_Id";
        $np = array();
        $np[':Player_Id'] = $_GET["Player_Id"];
        $np[':first_name']  = $_GET["first_name"];
        $np[':last_name']  = $_GET["last_name"];
        $np[':nba_years']  = $_GET["nba_years"];
        $np[':current_team']  = $_GET["current_team"];
        $np[':carrer_points']  = $_GET["carrer_points"];
        $np[':championships']  = $_GET["championships"];
        $np[':picture']  = $_GET["picture"];
        
        $statement = $db->prepare($sql);
        $statement->execute($np);
    }
    if(isset($_GET['Player_Id'])){
        $records = getPlayerInfo();
        foreach($records as $record)
        {
            // echo "</br>";
            // $img = $record['picture'];
            // echo "<img src='$img'>" . "</br>";
            // echo $record["first_name"] . " " . $record["last_name"] . " points: " . $record['carrer_points'] . "Champasduifgwquf: " . $record['championships'] ;
        }
    }
    
   
?>

<html>
    <head>
        
    </head>
    <body>
        <form>
            <input type="hidden" name="Player_Id" value="<?=$record['Player_Id']?>" />
            First Name: <input type="text" value="<?=$record['first_name']?>" name="first_name" />
            <br>
            Last Name: <input type="text" value="<?=$record['last_name']?>" name="last_name" />
            <br>
            
            NBA years: <input type="text" value="<?=$record['nba_years']?>" name="nba_years" />
            <br>
            
            Current Team: <input type="text" value="<?=$record['current_team']?>" name="current_team" />
            <br>
            
            Carrer Points: <input type="text" value="<?=$record['carrer_points']?>" name="carrer_points" />
            <br>
            
            Number of Championships: <input type="text" value="<?=$record['championships']?>" name="championships" />
            <br>
            
            Link to player picture: <input type="text" value="<?=$record['picture']?>" name="picture" />
            <br>
            <input type="submit" name="updatePlayer" value="update player"/>    
        </form>
        <br>
        <form action="logout.php">
            <input type="submit" value="logout">
        </form>
        
    </body>
</html>