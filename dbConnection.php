<?php

function getDataFun($stmt){
    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data from the result set
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>