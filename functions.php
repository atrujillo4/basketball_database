<?php
function getDatabaseConnection() {
    // $host = "localhost";
    // $username = "Adrian";
    // $password = "wsn4life";
    // $dbname = "NBA_Database"; 
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b26dde437507d2";
    $password = "2f51c9d0";
    $dbname = "heroku_c89fb504cd3a0f0";
    //mysql://b26dde437507d2:2f51c9d0@us-cdbr-iron-east-05.cleardb.net/heroku_c89fb504cd3a0f0?reconnect=true
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn; 
}

function insertItemsIntoDB($fname, $lname, $years, $team, $points, $ships, $pic){
    $db = getDatabaseConnection();
    $sql = "INSERT INTO Players (first_name, last_name, nba_years, current_team, carrer_points, championships, picture) 
            VALUES (:first_name, :last_name, :nba_years, :current_team, :carrer_points, :championships, :picture)";
    $statement = $db->prepare($sql);
    $statement->execute(array(
            first_name => $fname,
            last_name => $lname,
            nba_years => $years,
            current_team => $team,
            carrer_points => $points,
            championships => $ships,
            picture => $pic
    ));
}

function getMatchingItems($fname, $lname, $years, $team, $pointsf, $pointst, $ships){
    $db = getDatabaseConnection(); 
    //$imgSQL = $showImages ? ', item.image_url' : '';
    $sql = "SELECT * FROM Players WHERE 1";
    //$sql = "SELECT * FROM Players WHERE 1";
    //$sql = "SELECT DISTINCT item.item_id, item.name, item.price $imgSQL FROM item INNER JOIN item_category ON item.item_id = item_category.item_id INNER JOIN category ON item_category.category_id =category.category_id  WHERE 1"; 
    if(!empty($fname)){
        $sql .= " AND first_name LIKE '%$fname%'";
    }
    if(!empty($lname)){
        $sql .= " AND last_name LIKE '%$lname%'";
    }
    if(!empty($years)){
        $sql .= " AND nba_years = '$years'";
    }
    if(!empty($team)){
        $sql .= " AND current_team = '$team'";
    }
    if(!empty($pointsf)){
        $sql .= " AND carrer_points >= '$pointsf'";
    }
    if(!empty($pointst)){
        $sql .= " AND carrer_points <= '$pointst'";
    }
    if(!empty($ships)){
        $sql .= " AND championships = '$ships'";
    }
    // if(!empty($ordering)){
    //     if($ordering == 'product'){
    //         $columnName='item.name';
    //     }
    //     else{
    //         $columnName='item.price';
    //     }
    //     $sql .= " ORDER BY $columnName";
    // }
    
    
    $statement = $db->prepare($sql);
    $statement->execute();
    //echo "$sql";
    // $items = $statement->fetchAll();
    // return $items;
    // foreach($items as $item){
    //     echo $items["first_name"] . "<br>";
    // }
    
    $records = $statement->fetchAll();
    return $records;
    // foreach($records as $record)
    // {
    //     echo "</br>";
    //     $img = $record['picture'];
    //     echo "<img src='$img'>" . "</br>";
    //     echo $record["first_name"] . " " . $record["last_name"] . " points: " . $record['carrer_points'] ;
    // }
}

function displayForAdmin(){
    $db = getDatabaseConnection();
    $sql = 'SELECT * FROM Players ORDER BY first_name';
    $statement = $db->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    foreach($records as $item){
        $playerId = $item['Player_Id'];
        $first_name = $item['first_name'];
        $last_name = $item['last_name'];
        $current_team = $item['current_team'];
        $pic = $item['picture'];
        $points = $item['carrer_points'];
        echo "<img src='" . $pic . "' style='width=100px;height:100px;'>" ."$first_name" . " " . "$last_name" . " Current team: " . "$current_team" . " Carrer points: " . $points;
        echo "<td><a href='updatePlayer.php?Player_Id=$playerId' class='btn btn-outline-primary' role='button' aria-pressed='true'>Update</a>";
        echo " "; 
        echo "<a href='deletePlayer.php?Player_Id=$playerId' onclick='return confirm(\"Are you sure you want to delete?\")' class='btn btn-outline-danger' role='button' aria-pressed='true'>Delete</a></td>";
        echo "<br>";
    }
}

function getPlayerInfo(){
    $db = getDatabaseConnection();
    $sql = "SELECT * FROM Players WHERE Player_Id = " . $_GET['Player_Id'];
    echo $sql;
    
    echo $_GET['Player_Id'];
    $statement = $db->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    // foreach($records as $record)
    // {
    //     echo "</br>";
    //     $img = $record['picture'];
    //     echo "<img src='$img'>" . "</br>";
    //     echo $record["first_name"] . " " . $record["last_name"] . " points: " . $record['carrer_points'] ;
    // }
    return $records;
}

function displayResults(){
    global $items;
    if(isset($items)){
        echo '<table>';
        foreach($items as $item){
            $player_first_name = $item['first_name'];
            $player_last_name = $item['last_name'];
            $player_current_team = $item['current_team'];
            $playerImage = $item['picture'];
            $playerId = $item['Player_Id'];
            $itemName = $item['name'];
            $itemPrice = $item['price'];
            $itemImage = $item['image_url'];
            $itemId = $item['item_id'];
            $playerName = $player_first_name . " " . $player_last_name;
            echo "<te>";
            echo "<td> <img src='$playerImage'> </td>";
            echo "<td> <h4> <a href=\"playerInfo.php?Player_Id=" . $item['Player_Id'] ."\" target='blank' > $playerName </a> </h4> </td>";
            echo "<td> <h4> $player_current_team </h4> </td>";
            //echo "<td> $playerId </td>";
            echo "<td> <h4> $itemPrice </h4> </td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='playerName' value='$playerName'>";
            echo "<input type='hidden' name='playerId' value='$playerId'>";
            echo "<input type='hidden' name='playerImage' value='$playerImage'>";
            echo "<input type='hidden' name='playerTeam' value='$playerTeam'>";
            // if($_POST['itemId'] == $itemId){
            //      echo "<td><button class='btn btn-success'>Added</button></td>";
            // } else {
            //      echo "<td><button class='btn btn-warning'>Add</button></td>";
            // }
            echo "</form>";
            echo "</tr>";
        }
        echo '</table>';
    }
    
}

?>