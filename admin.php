<?php
    include 'functions.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <form method="post">
            <input type="text" name="first_name" placeholder="First Name"/><br />
            <input type="text" name="last_name" placeholder="Last Name"/><br />
            <input type="text" name="nba_years" placeholder="Years in NBA"/><br />
            <input type="text" name="current_team" placeholder="Current Team"/><br />
            <input type="text" name="carrer_points" placeholder="Carrer Points"/><br />
            <input type="text" name="championships" placeholder="Number of Championships"/><br />
            <input type="text" name="picture" placeholder="Picture Link"/><br />
            
            <input type="submit" name="add_record" value="Add"/>
        </form>
        
        
        
        <form action="logout.php">
            <input type="submit" value="logout">
        </form>
        
        <?php
        if(isset($_POST['add_record'])){
            insertItemsIntoDB($_POST['first_name'], $_POST['last_name'], 
            $_POST['nba_years'], $_POST['current_team'], $_POST['carrer_points'],
            $_POST['championships'], $_POST['picture']);
        }
        
        echo "<br>";
        displayForAdmin();
        //getMatchingItems($_POST['first_name'], $_POST['last_name'], $_POST['nba_years'], $_POST['current_team'], $_POST['from_carrer_points'], $_POST['to_carrer_points'], $_POST['championships']);
        ?>
    </body>
    <hr>
        <footer>
            <p>Created by: Adrian Trujillo</p>
            <p>CST336: Internet Programming</p>
        </footer>
    </hr>
</html>

