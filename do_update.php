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

// TODO: validate form data
$id = $city = $state = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["id"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// TODO: update the city and state based on the id
// NOTE: you can't update the school name
$sql = "UPDATE opponent SET  city='$_REQUEST[city]', state='$_REQUEST[state]' WHERE id='$_REQUEST[id]'";

// TODO: communicate any errors using the session ('error' key)
if ($conn->query($sql) === TRUE) {
    $_SESSION['error'] = '';
} else {
    $_SESSION['error'] = "Error updating record: " . $conn->error;
}
// TODO: close the database connection
$conn->close();

header("location:index.php");
?>
