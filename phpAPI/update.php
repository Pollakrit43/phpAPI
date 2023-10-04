<?php
require 'connectDB.php';

// Get the raw JSON data from the request body
$jsonData = file_get_contents('php://input');

// Parse the JSON data into an associative array
$data = json_decode($jsonData, true);

// Check if the expected keys exist in the parsed data
if (isset($data['ShopName']) && isset($data['Address']) && isset($data['PhoneNumber']) && isset($data['ID'])) {
    $shopname = $data['ShopName'];
    $address = $data['Address'];
    $phonenumber = $data['PhoneNumber'];
    $id = $data['ID']; // Assuming 'ID' is the primary key

    // Define the SQL query for updating the record
    $tsql = "UPDATE Shops SET ShopName = ?, Address = ?, PhoneNumber = ? WHERE ID = ?";

    $params = array($shopname, $address, $phonenumber, $id);

    $updateStmt = sqlsrv_query($conn, $tsql, $params);

    if ($updateStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Record updated successfully!";
    }

    sqlsrv_free_stmt($updateStmt);
    sqlsrv_close($conn);
} else {
    // Handle the case where the expected keys are not present
    echo "Invalid JSON data. Please provide ShopName, Address, PhoneNumber, and ID.";
}
?>
