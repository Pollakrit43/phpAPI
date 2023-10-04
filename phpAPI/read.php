<?php
require 'connectDB.php';

// Define the SQL query to retrieve data
$query = "SELECT * FROM Shops";

$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$shops = array();

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $shops[] = $row;
}

// Convert the result to JSON and send it as the API response
header('Content-Type: application/json');
echo json_encode($shops);

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
