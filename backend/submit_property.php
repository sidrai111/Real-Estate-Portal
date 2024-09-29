<?php
// $host = "localhost";
// $user = "dosgood1";
// $pass = "dosgood1";
// $dbname = "dosgood1";

//Create connection
$db = mysqli_connect($host, $user, $pass, $dbname);
    
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
$stmt = $conn->prepare("INSERT INTO property (owner, detail, sqft, acreage, rooms, baths, bedrms, yr, yard, parking, price)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssidiibid", $_SESSION["user_id"],$detail, $sqft, $baths, $bedrooms, $year, $yard, $parking, $price);

$detail = $_POST["facilities"];
$sqft = $_POST["floor-plan"];
$baths = $_POST["baths"];
$bedrooms = $_POST["bedrooms"];
$year = $_POST["age"];
$yard = $_POST["garden"];
if($_POST["parking"] == "Yes"){
    $parking = true;
} else {
    $parking = false;
}
$price = $_POST["property-value"];
$stmt->execute();

echo "Property data created successfully";
$stmt->close();

// If upload button is clicked ...
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../images/" . $filename;
 
    // Get all the submitted data from the form
    $sql = "INSERT INTO img (img_name, img_type) VALUES ('$filename', '?')";
 
    // Execute query
    mysqli_query($db, $sql);
 
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }
$conn->close();
header("Location: ../frontend/seller.html");
exit();
?>
