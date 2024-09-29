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

//SWAP OUT FOR COMMENTS WHEN HTML IS MADE
$username = $_POST["username"];
$passwd = $_POST["password"];

//Searching for username
$sql = "SELECT * FROM user WHERE username='$username'";
$query = $conn->query($sql);

if ($query !== false && $query->num_rows > 0) {
    echo "Correct Username";

    $row = $query->fetch_assoc();
    
    if(password_verify($passwd, $row['passwrd'])){

        //Enter page to go to when made
        echo "Correct Password";
        echo "Login Successful";
        $_SESSION["user_id"]=$username;
        header("Location: ../frontend/seller.html");
    } else{
        echo "Incorrect Password";
    }

}
else {
    echo "Incorrect username";
}
$conn->close();
header("Location: ../frontend/seller.html");
exit();
?>
