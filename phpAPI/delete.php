<?php
require 'connectDB.php';

// Get the raw JSON data from the request body
$jsonData = file_get_contents('php://input');

// Parse the JSON data into an associative array
$data = json_decode($jsonData, true);

// Check if the 'id' query parameter exists in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the 'id' from the URL query parameter

    // Define the SQL query for deleting the record
    $tsql = "DELETE FROM Shops WHERE ID = ?";

    $params = array($id);

    $deleteStmt = sqlsrv_query($conn, $tsql, $params);

    if ($deleteStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Record deleted successfully!";
    }

    sqlsrv_free_stmt($deleteStmt);
    sqlsrv_close($conn);
} else {
    // Handle the case where the 'id' query parameter is not present
    echo "Invalid request. Please provide an 'id' query parameter.";
}
?>
