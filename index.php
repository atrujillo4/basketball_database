<?php
    include "functions.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        
        <style> @import url("css/style.css");</style>
       
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script>
            $(document).ready(function(){
                $("#username").change(function(){
                    //alert("wtf");
                });
            });
        </script>
        <title>NBA Database</title>
    </head>
    <body>
        
        <form method="post" action="loginprocess.php">
            <div id="login">
                <input type="text" name="username" id="username" placeholder="Username" /><br />
                <input type="password" name="password" placeholder="Password"/><br />
                <input type="submit" name="submit" value="Login"/>
            </div>
        </form>
        
        <script>
            $(document).ready(function(){
                $("#username").change(function(){
                    //alert("username changed");
                });
            });
        </script>
        <script>
            
                $(document).ready(function(){
                    // alert("YES");
                    // alert("GOOD");
                    $("#username").on("change",function(){ 
                        //alert("testse");
                        // $.ajax({
                        //     type: "GET",
                        //     url: "loginprocess.php",
                        //     dataType: "json",
                        //     data: {"username":$("#username").val(),
                        //     },
                        //     success: function(data, status){
                        //         if(data.length > 0){
                        //             alert("testest")
                        //             $('#username-valid').html("Usresasdas");
                        //         }
                        //         else{
                        //             alert("fdsfsdf");
                        //             $('#username-valid').html("Usrfsadfsdfsdfsdesasdas");
                        //         }
                        //     }
                       // });
                    });
                    //alert("test");
                });
            
        
    </script>
        
    <?php
    // if(isset($_POST['submit'])){
    //     if($_POST['username'] == 'Admin' && $_POST['password'] == 's3cr3t'){
    //         header("Location:admin.php");
    //     } else {
    //         header("Location:error.php");
    //     }
    // }
    ?>
    <br>
    </br>
    NBA Database
    Search by:
    <?php
    //getMatchingItems("LeBron");
    ?>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name"/><br />
        <input type="text" name="last_name" placeholder="Last Name"/><br />
        <input type="text" name="nba_years" placeholder="Years in NBA"/><br />
        <input type="text" name="current_team" placeholder="Current Team"/><br />
        <input type="text" name="from_carrer_points" placeholder="Carrer Points(from)"/> 
        <input type="text" name="to_carrer_points" placeholder="Carrer Points(to)"/> <br />
        <input type="text" name="championships" placeholder="Number of Championships"/><br />
        <input type="submit" name="Search" value="Search"/>
    </form>
    
    <?php
    
    if(isset($_POST['Search'])){
        //Creating an array to hold an item's properties
        $newItem = array();
        $newItem['first_name'] = $_POST['first_name'];
        $newItem['last_name'] = $_POST['last_name'];
        $newItem['nba_years'] = $_POST['nba_years'];
        $newItem['current_team'] = $_POST['current_team'];
        $newItem['from_carrer_points'] = $_POST['from_carrer_points'];
        $newItem['to_carrer_points'] = $_POST['to_carrer_points'];
        $newItem['championships'] = $_POST['championships'];
        $newItem['Player_Id'] = $_POST['PlayerId'];
    }
    if(isset($_POST['Search'])){
        
        $items = getMatchingItems($_POST['first_name'], $_POST['last_name'], $_POST['nba_years'], $_POST['current_team'], $_POST['from_carrer_points'], $_POST['to_carrer_points'], $_POST['championships']);
    }
        "<div id='results'>";
        displayResults();
        "</div>";
    ?>
    
    </body>
    <hr>
        <footer>
        <p>Created by: Adrian Trujillo</p>
        <p>CST336: Internet Programming</p>
        
        </footer>
    </hr>
    
    
</html>