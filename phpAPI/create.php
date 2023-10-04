<?php
require 'connectDB.php';

// Get the raw JSON data from the request body
$jsonData = file_get_contents('php://input');

// Parse the JSON data into an associative array
$data = json_decode($jsonData, true);


// Check if the expected keys exist in the parsed data
if (isset($data['ShopName']) && isset($data['Address']) && isset($data['PhoneNumber'])) {
    $shopname = $data['ShopName'];
    $address = $data['Address'];
    $phonenumber = $data['PhoneNumber'];

    // Define the SQL query for insertion
    $tsql = "INSERT INTO Shops (ShopName, Address, PhoneNumber) VALUES (?, ?, ?)";

    $params = array($shopname, $address, $phonenumber);

    $insertStmt = sqlsrv_query($conn, $tsql, $params);

    if ($insertStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Record created successfully!";
    }

    sqlsrv_free_stmt($insertStmt);
    sqlsrv_close($conn);
} else {
    // Handle the case where the expected keys are not present
    echo "Invalid JSON data. Please provide ShopName, Address, and PhoneNumber.";
}
?>
