<?php session_start();

// TODO: create a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "una_bball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$username = $password = "";



// TODO: use the users table for authentication
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["enduser"];
    $password = $_POST["userpass"];
}
// TODO: create variables for the input form data
// define variables and set to empty values

$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$row = mysqli_fetch_array($query);

if (password_verify($password,$row['password'])) {
    $_SESSION['username'] = $username;
    $_SESSION['error'] = '';
} else {
    $_SESSION['error'] = 'invalid username or password';
}
// TODO: close the database connection
$conn->close();

header("location:index.php");
?>
