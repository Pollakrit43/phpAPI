<?php
$serverName = "BOATPC\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "workDB",
    "Uid" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>