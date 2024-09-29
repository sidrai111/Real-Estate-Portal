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

$sql = "CREATE TABLE IF NOT EXISTS user (
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(255) NOT NULL
    )";
if ($conn->query($sql) === TRUE) {
    echo "user table created successfully\n";
}
else {
    echo "Error creating user table: " . $conn->error;
}

/** create properties table if not exist
 */
$sql = "CREATE TABLE IF NOT EXISTS property (
    id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    detail VARCHAR(255),
    sqft INT(6),
    acreage DECIMAL(5,2),
    rooms INT(6),
    baths DECIMAL(5,2),
    bedrms INT(6),
    yr INT(6),
    yard BOOLEAN,
    parking BOOLEAN,
    price DECIMAL(5,2),
    FOREIGN KEY (owner) REFERENCES user(username)
    )";
if ($conn->query($sql) === TRUE) {
    echo "property table created successfully\n";
}
else {
    echo "Error creating prop table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS addr (
    id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    prop_id INT(6) UNSIGNED,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    st VARCHAR(255) NOT NULL,
    zip INT(6) NOT NULL,
    FOREIGN KEY (prop_id) REFERENCES property (id)
        ON DELETE SET NULL
    )";
if ($conn->query($sql) === TRUE) {
    echo "address table created successfully\n";
}
else {
    echo "Error creating addr table: " + $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS img (
    id INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    prop_id INT(6) UNSIGNED,
    img_name VARCHAR(255) NOT NULL,
    img_type VARCHAR(255) NOT NULL,
    FOREIGN KEY (prop_id) REFERENCES property(id)
        ON DELETE SET NULL
    )";
if ($conn->query($sql) === TRUE) {
    echo "img table created successfully\n";
}
else {
    echo "Error creating img table: " + $conn->error;
}

// $sql = "CREATE TABLE IF NOT EXISTS owner (
//     username VARCHAR(255) NOT NULL,
//     prop_id INT(6) UNSIGNED NOT NULL,
//     FOREIGN KEY (username) REFERENCES user(username),
//     FOREIGN KEY (prop_id) REFERENCES property(id),
//     PRIMARY KEY (username, prop_id)
// )";
// if ($conn->query($sql) === TRUE) {
//     echo "owner table created successfully\n";
// }
// else {
//     echo "Error creating owner table: " + $conn->error;
// }

$conn->close();
?>