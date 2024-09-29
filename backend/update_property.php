<?php
    // $host = "localhost";
    // $user = "mcoca1";
    // $pass = "mcoca1";
    // $dbname = "mcoca1";
    
    //Create connection
    $conn = new mysqli($host, $user, $pass, $dbname);
    
    //Check connection
    if($conn->connect_error) {
        echo "Could not connect to server\n";
        die("Connection failed: " . $conn->connect_error);
    } 
    $stmt = $conn->prepare("UPDATE property
    SET detail = ?, sqft = ?, acreage = ?, rooms = ?, baths = ?, bedrms = ?, yr = ?, yard = ?, parking = ?, price = ?
    WHERE id = ?");
    $stmt->bind_param("sidiibidi", $detail, $sqft, $baths, $bedrooms, $year, $yard, $parking, $price, $propId);

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
    $conn->close();
    header("Location: ../frontend/seller.html");
    exit();
?>