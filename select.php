<?php session_start();
    if (!isset($_SESSION['username'])) {
        header("location:index.php");
        // Make sure that code below does not get executed when we redirect.
        exit(0);
    }
    
    // TODO: connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "una_bball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <!-- TODO: display all opponent data except id -->
        <?php
               

        
        $sql = "SELECT school, city, state FROM opponent";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "School: " . $row["school"] . " - City: " . $row["city"] . " - State " . $row["state"] . "<br>";
            }
        } else {
            echo "0 results";
        }
                $conn->close();
                ?>

        <!-- TODO: create a navigational link to the main menu -->
    <li><a href="menu.html">Main Menu</a></li>
    </body>
</html>
