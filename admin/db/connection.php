<?php

$GLOBALS['product_'] = uniqid('product_');

$host = "localhost"; // or your MySQL server's IP address
$username = "root"; // the MySQL username
$password = ""; // the MySQL password
$database = "cart"; // the name of your MySQL database

// Create a MySQL connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function getDataFun($stmt)
{
    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data from the result set
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Close the connection
// mysqli_close($conn);



?>