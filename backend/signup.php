<?php
$host = "localhost";
$user = "mcoca1";
$pass = "mcoca1";
$dbname = "mcoca1";


//Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

//Check connection
if($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
}

//prepare statement
$stmt = $conn->prepare("INSERT INTO user (firstname, lastname, email, username, passwrd)
VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $hash);

//Users data, replace tests with post variables once html page created
$firstname = $_POST["first-name"];
$lastname = $_POST["last-name"];
$email = $_POST["email"];
$username = $_POST["username"];
$passwrd = $_POST["password"];
$hash = password_hash($passwrd, PASSWORD_DEFAULT);
$stmt-> execute();

echo("Account created successfully.\n");

$stmt->close();
$conn->close();
header("Location: ../frontend/login.html");
exit();
?>
